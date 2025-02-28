<?php

namespace App\Http\Controllers;
use App\Helper\RandomCode;
use App\Mail\InvoiceMail;
use App\Mealoffer;
use App\Models\Branch;
use App\Models\BranchProduct;
use App\Models\BranchStaff;
use App\Models\Category;
use App\Models\Provider;
use App\Models\Rate;
use App\Offer;
use App\Repository\BranchProductRepository;
use App\Repository\CartRepository;
use App\Repository\OrderprovidersRepository;
use App\Repository\OrderRepository;
use App\Repository\PaypalprovidersRepository;
use App\Repository\ProductSauceRepository;
use App\Repository\ProviderRepository;
use App\Repository\RateRepository;
use App\Repository\SettingRepository;
use App\Services\ApiResponseService;
use App\Setting;
use Carbon\Carbon;
use Cookie;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Srmklive\PayPal\Services\ExpressCheckout;
use Tymon\JWTAuth\Facades\JWTAuth;

class PayPalPaymentController extends Controller
{

    protected $ProductSauceRepo;
    protected $ProductRepo;
    protected $cartRepo;
    protected $orderRepo;
    protected $apiResponse;
    protected $ordersRepo;
    protected $paypalRepo;
    protected $SettingRepo;
    protected $providerRepo;
    protected $RateRepo;

    public function __construct(RateRepository $RateRepo,SettingRepository $SettingRepo,ProviderRepository $providerRepo,PaypalprovidersRepository $paypalRepo,OrderRepository $orderRepo, OrderprovidersRepository $ordersRepo, CartRepository $cartRepo, BranchProductRepository $ProductRepo, ProductSauceRepository $ProductSauceRepo, ApiResponseService $apiResponse)
    {
        $this->ProductSauceRepo = $ProductSauceRepo;
        $this->ProductRepo = $ProductRepo;
        $this->cartRepo = $cartRepo;
        $this->orderRepo = $orderRepo;
        $this->ordersRepo = $ordersRepo;
        $this->PaypalRepo = $paypalRepo;
        $this->apiResponse = $apiResponse;
        $this->SettingRepo = $SettingRepo;
        $this->providerRepo = $providerRepo;
        $this->RateRepo = $RateRepo;

    }

    public function handlePayment($data = [])
    {

        $share_setting = Setting::first();
        $product = [];
        $cart = $this->cartRepo->with('product', 'sauce')->where('user_id', auth()->id())->get();

        foreach ($cart as $key => $item) {
            $product['items'] = [
                [
                    'name' => $item->product_id,
                    'price' => $item->product->price,
                    'desc'  => $data->comment[$key],
                    'qty' => $item->qty
                ]
            ];
        }
        $product['invoice_id'] = "Eboro_Invoice_".RandomCode::getToken(3);
        $product['invoice_description'] = "Order #{$product['invoice_id']} Bill";
        $product['return_url'] = route('success.payment');
        $product['cancel_url'] = route('cancel.payment');
        $product['total'] = Round((auth()->user()->carts->sum('price') + (auth()->user()->carts->sum('price') * $share_setting->tax) + (SiteController::distance2($data['drop_lat'], $data['drop_long'])["shipping"] * $share_setting->shipping)),2);
        $paypalModule = new ExpressCheckout;
        $res = $paypalModule->setExpressCheckout($product);
        $res = $paypalModule->setExpressCheckout($product, true);
        return redirect($res['paypal_link']);
    }

    public function paymentCancel(Request $request)
    {

        $paypalModule = new ExpressCheckout;
        $response = $paypalModule->getExpressCheckoutDetails($request->token);
        $Get_user = $this->PaypalRepo->where(['TOKEN' => $response["TOKEN"]??'-1'])->first();
        auth()->loginUsingId($Get_user->user_id??-1);
        return view('site.pages.payment.failed', $this::GData());
    }

    public function paymentSuccess(Request $request)
    {

        $paypalModule = new ExpressCheckout;
        $share_setting = Setting::first();
        $response = $paypalModule->getExpressCheckoutDetails($request->token);
        $Get_user = $this->PaypalRepo->where(['TOKEN' => $response["TOKEN"]??'-1'])->first();

        auth()->loginUsingId($Get_user->user_id??-1);

        $total = 0;
        $dataIt['items'] = [];
        $shipping = $response['L_AMT0'];

        $dataIt['items'][] = [
            'name' => "Shipping",
            'price' => $shipping,
            'desc' => "Eboro delivery services",
            'qty' => 1
        ];
        foreach (auth()->user()->carts as $key => $item) {
            $price = $this->getF($item, $share_setting);
            $dataIt['items'][] = [
                'name' => $item->product->name,
                'price' => $price,
                'desc' => $data["comment"][$key] ?? "",
                'qty' => $item->qty
            ];
            $total += $price * $item->qty;
        }


        $dataIt['total'] = $response['AMT'];
        $dataIt['invoice_description'] = $response['DESC'];
        $dataIt['invoice_id'] = $response['INVNUM'];
        $validation = $paypalModule->doExpressCheckoutPayment($dataIt, $request->token, $request->PayerID);
        if ($validation['ACK'] != 'Failure' && $validation['ACK'] == 'Success')
        {
            $OrderData = $this->PaypalRepo->where(['TOKEN' => $response["TOKEN"]])->first();
            $share_setting = Setting::first();
            $cart = $this->cartRepo->with('product', 'sauce')->where('user_id', auth()->id())->get();
            if ($cart->count() == 0) {
                return $this->apiResponse->setError(trans('admin.no_product'))->setCode(400)->send();
            }
            DB::beginTransaction();
            $nearest = [];

            $insert['ordar_at'] = $OrderData['ordar_at'];
            $insert['user_id'] = $OrderData['user_id'];
            $insert['drop_address'] = $OrderData['drop_address'];
            $insert['drop_long'] = $OrderData['drop_long'];
            $insert['drop_lat'] = $OrderData['drop_lat'];
            $insert['paypal_EMAIL'] = $response['EMAIL'];
            $insert['paypal_CURRENCY'] = $response['CURRENCYCODE'];
            $insert['paypal_PAYERID'] = $response['PAYERID'];
            $insert['paypal_ITEMAMT'] = $response['ITEMAMT'];
            $insert['paypal_TIMESTAMP'] = $response['TIMESTAMP'];
            $insert['paypal_BUILD'] = $response['BUILD'].'/state/'.$validation['PAYMENTINFO_0_PAYMENTSTATUS'];
            $insert['payment'] = 2;

            if (count($cart->pluck('product.branch.provider_id')->unique()) == 1)
            {
                $nearestBranch = Branch::select(DB::raw('*, ( 6371 * acos( cos( radians(' .
                    $insert['drop_lat'] . ') ) * cos( radians(`lat`) ) * cos(radians(`long`) - radians(' .
                    $insert['drop_long'] . ') ) + sin( radians(' . $insert['drop_lat'] .
                    ') ) * sin( radians(`lat`) ) ) ) as distance'))
                    ->having('distance', '<=', $share_setting->range ?? 60)
                    ->orderBy('distance')->where('provider_id', auth()->user()->carts[0]->product->branch->provider_id)->first();
                if ($nearestBranch)
                    $insert['branch_id'] = $nearestBranch->id;
                else
                    $insert['branch_id'] = auth()->user()->carts[0]->product->branch_id;
            }
            else
            {
                foreach (auth()->user()->carts->pluck('product.branch.provider_id')->unique() as $key => $item)
                {
                    $nearestBranch = Branch::select(DB::raw('*, ( 6371 * acos( cos( radians(' .
                        $insert['drop_lat'] . ') ) * cos( radians(`lat`) ) * cos(radians(`long`) - radians(' .
                        $insert['drop_long'] . ') ) + sin( radians(' . $insert['drop_lat'] .
                        ') ) * sin( radians(`lat`) ) ) ) as distance'))
                        ->having('distance', '<=', $share_setting->range ?? 60)->orderBy('distance')->where('provider_id', $item)->first();

                    if ($nearestBranch != "")
                    {
                        array_push($nearest, $nearestBranch);
                    }
                }
                $insert['branch_id'] = null;
            }

            $Shipping_par  = (SiteController::distance2($insert['drop_lat'], $insert['drop_long'],"need"));
            $insert['total_price'] = (auth()->user()->carts->sum('price') + (auth()->user()->carts->sum('price') * $share_setting->tax) + $Shipping_par["shipping"]);
            $insert['tax_price'] = (auth()->user()->carts->sum('price') * $share_setting->tax);
            $insert['shipping_price'] = $Shipping_par["shipping"];
            $insert['Delivery_time'] = $Shipping_par["Duration"] ?? "unknown";
            $insert['Delivery_distance'] = $share_setting->de_start??180 + ($share_setting->de_per_km??30 * $Shipping_par["Distance"]??1);
            $order = $this->orderRepo->create($insert);

            foreach ($nearest as $item)
            {

                $POP = $this->cartRepo->with('product')->whereHas('product.branch',function ($q) use ($item){
                    $q->where(['branch_id'=> $item->id, 'user_id'=> auth()->id()]);
                })->sum('price');

                $order->branches()->create([
                    'branch_id' => $item->id,
                    'total_price' => ($POP + ($POP * $share_setting->tax)),
                    'tax_price' => ($POP * $share_setting->tax),
                    'shipping_price' => $Shipping_par["shipping"],
                ]);
            }

            foreach ($cart as $key => $item) {
                $order->content()->create([
                    'product_id' => $item->product_id,
                    'sauce_id' => $item->sauce_id,
                    'price' => $item->product->price,
                    'qty' => $item->qty,
                ]);
            }

            $this->cartRepo->with('product', 'product', 'sauce')->where('user_id', auth()->id())->delete();
            Mail::to($order->user->email)->send(new InvoiceMail($order));
            DB::commit();
            return view('site.pages.payment.success', $this::GData());

        }
        return view('site.pages.payment.failed', $this::GData());
    }


    public static function GData()
    {
        $time = Carbon::now();
        $offers = Offer::whereDate('start_at','<=', $time)
            ->whereDate('end_at','>=', $time)
            ->get();

        $meal_offers = Mealoffer::whereDate('start_at','<=', $time)
            ->whereDate('end_at','>=', $time)
            ->get();
        if (Auth::user())
        {

            $user = Auth::user();
            $Token = 'Bearer ' . JWTAuth::fromUser($user);
            $BranchStaffs = BranchStaff::where(["user_id" => Auth::user()->id])->get();
            $Branches = Branch::whereIn("id" , $BranchStaffs->pluck('branch_id')->toArray())->get();
            if(Auth::user()->type ==3 || Auth::user()->type ==4)
            {
                $MyProviders = Provider::whereIn("id" , $Branches->pluck('provider_id')->toArray())->where(['lock' => 'unlock'])->get();
            }
            else
            {
                $MyProviders = Provider::where(["user_id" => Auth::user()->id,'lock' => 'unlock'])->get();
            }
            $MyRate = Rate::where(["user_id" => Auth::user()->id])->get();

        }
        else
        {
            $Token = "";
            $MyProviders = "";
            $MyRate = "";
        }

        $Categories = Category::get();
        $Providers = Provider::where(['lock' => 'unlock'])->get();
        $products = BranchProduct::get();
        $items = BranchProduct::where(["product_type" => "Food"])->get();
        $Addition = BranchProduct::where(["product_type" => "Addition"])->get();
        $Rate = Rate::get();
        $setting = Setting::first();
        return compact('Categories', 'Providers', 'Token', 'MyProviders', 'items', 'Addition', 'Rate', 'MyRate' ,'offers','meal_offers','products','setting');
    }


    public function getF($item, $share_setting): float
    {
        $off = $item->product->offer;
        $pp = $item->product->offer ? ($item->product->price - (($off->value / 100) * $item->product->price)) : $item->product->price;
        $price = round($pp * 1 + ($pp * $share_setting->tax * 1), 2);
        return $price;
    }

}
