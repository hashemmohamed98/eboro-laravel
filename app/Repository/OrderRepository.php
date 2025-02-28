<?php

namespace App\Repository;

use App\Helper\RandomCode;
use App\Http\Controllers\SiteController;
use App\Models\Order;
use App\Models\OrderLog;
use App\Models\User;
use App\Payapal_order;
use App\PayapalOrder;
use App\Paypalorder;
use App\Services\ApiResponseService;
use App\Setting;
use Carbon\Carbon;
use Cookie;
use Illuminate\Support\Facades\DB;
use phpDocumentor\Reflection\Types\Integer;
use Srmklive\PayPal\Services\ExpressCheckout;
use Stripe\Charge;
use Stripe\Customer;
use Stripe\Stripe;
use Stripe\Token;

class OrderRepository extends Repository
{
    protected $model;
    protected $apiResponse;

    public function __construct(Order $model, ApiResponseService $apiResponse)
    {
        $this->model = $model;
        $this->apiResponse = $apiResponse;

    }

    public function payment($data = [])
    {
        Stripe::setApiKey(config('services.stripe.secret'));
        $share_setting = Setting::first();
        $month =  explode('/', $data['card_date'])[0];
        $year =  explode('/', $data['card_date'])[1];
//        $answer = new \DateTime();
//        $month =  date('m', explode('/', $data['card_date'])[0]);
//        $year =  date('y', explode('/', $data['card_date'])[1]);
//        $answer->setDate($year, $month, 0);
       try{
           $token = Token::create(array(
               "card" => array(
                   "number" => $data['card_number'],
                   "exp_month" => $month,
                   "exp_year" => $year,
                   "cvc" => $data['card_cvv'],
                   "name" => $data['card_name']??auth()->user()->name
               )
           ));

           if (!isset($token['id']))
               return false;

           $shipping = (SiteController::distance2(auth()->user()->lat, auth()->user()->long)["shipping"]);
           $total = 0;

           if(!is_numeric($shipping))
               return $this->apiResponse->setError("this location is so far no shipping for it at this moment sorry")->setCode(403)->send(403);

           foreach (auth()->user()->carts as $key => $item) {
               $price = $this->getF($item, $share_setting , $data) * $item->qty;
               $total += $price;
           }

           $customer = Customer::create(array(
               'email' => auth()->user()->email,
               'source' => $token['id']
           ));

           if (!isset($customer['id']))
               return false;

           $charge = Charge::create([
               'customer' => $customer['id'],
               'currency' => "EUR",
               'amount' => Round($total + $shipping ,2) * 100, // amount * 100 (1999 EUR) = € 19.99
               'description' => 'EBORO',
           ]);

       } catch (\Exception $e) {
           $body = $e->getJsonBody();
           $err  = $body['error'];
           return ['error' => $err['message']];
       }


        if ($charge['status'] == 'succeeded') {
            return $charge['id'];
        } else {
            return false;
        }
    }

    public function handlePayment($data = [])
    {
        $share_setting = Setting::first();
        $total = 0;
        $product['items'] = [];
        $shipping = (SiteController::distance2(auth()->user()->lat, auth()->user()->long)["shipping"]);

        if(!is_numeric($shipping))
            return $this->apiResponse->setError("this location is so far no shipping for it at this moment sorry")->setCode(403)->send(403);


        $product['items'][] = [
            'name' => "Shipping",
            'price' => $shipping,
            'desc' => "Eboro delivery services",
            'qty' => 1
        ];


        foreach (auth()->user()->carts as $key => $item) {
            $price = $this->getF($item, $share_setting , $data);
            $product['items'][] = [
                'name' => $item->product->name,
                'price' => $price,
                'desc' => $data["comment"][$key] ?? "",
                'qty' => $item->qty
            ];
            $total += $price * $item->qty;
        }

        if ($total <= 5) {
            return $this->apiResponse->setError("Please add items with more than 5 EUR")->setCode(403)->send(403);
        }

        $product['invoice_id'] = "EBORO_Invoice_".RandomCode::getToken(3);
        $product['invoice_description'] = "Order #{$product['invoice_id']} Bill";
        $product['return_url'] = route('success.payment');
        $product['cancel_url'] = route('cancel.payment');
        $product['total'] = $total + $shipping;

        $paypalModule = new ExpressCheckout;
        $res = $paypalModule->setExpressCheckout($product, true);

        if($res["paypal_link"] == null)
            return $this->apiResponse->setError("paypal issue contact the admin")->setCode(403)->send(403);

        Paypalorder::create([
            'user_id'=>auth()->id(),
            'drop_lat'=>$data['drop_lat'],
            'drop_long'=>$data['drop_long'],
            'drop_address'=>$data['drop_address'],
            'TOKEN'=>$res["TOKEN"],
            'BUILD'=>$res["BUILD"],
            'State'=>"Pending",
            'paypal_link'=>$res["paypal_link"],
            'ordar_at'=>$data["ordar_at"],
        ]);
        DB::commit();
        return $res['paypal_link'];
    }

    static function distance($lat1, $lon1, $lat2, $lon2)
    {
        if (($lat1 == $lat2) && ($lon1 == $lon2)) {
            return 0.1;
        } else {
            $theta = $lon1 - $lon2;
            $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
            $dist = acos($dist);
            $dist = rad2deg($dist);
            $miles = $dist * 60 * 1.1515;
            return round(($miles * 1.609344));
        }
    }

    public function getDistanceBetweenBranches($user, $branches)
    {
        return $this->distance($user->lat,$user->long,$branches->lat,$branches->long);
    }

    public function getNearestDel($users, $branches)
    {
        $nearestUser = null;
        $Distance = 500;
        foreach ($users as $user)
        {
            $Distances = $this->distance($user->lat,$user->long,$branches->lat,$branches->long);
            if($Distances <= $Distance)
            {
                $Distance = $Distances;
                $nearestUser = $user;
            }
        }
        return $nearestUser;
    }

    public function isInRange($Range,$branches)
    {
        $Distances = $this->distance(auth()->user()->lat,auth()->user()->long,$branches->lat,$branches->long);
        if($Distances <= $Range)
        { return true; }
        return false;
    }

    public function log($order,$status)
    {
        OrderLog::firstOrCreate([
            'order_id'=>$order->id,
            'delivery_id'=>auth()->id(),
            'delivery_status'=>$status,
        ]);
    }

    public function Setlog($order , $id ,$status)
    {
        OrderLog::firstOrCreate([
            'order_id'=>$order->id,
            'delivery_id'=>$id,
            'delivery_status'=>$status,
            'updated_at'=>Carbon::now()->toDateTimeString(),
        ]);
    }
    public function SetDeliveryState()
    {
        auth()->user()->last_session=Carbon::now()->toDateTimeString();
        auth()->user()->save();
        User::where("last_session" , '<=', Carbon::now()->subMinutes(3)->toDateTimeString())
            ->update(['online' => 0]);
    }

    public function getF($item, $share_setting , $data): float
    {
        $off = $item->product->offer;
        $price = $item->product->price + ($item->sauce->price ?? 0);
        $pp = $off ? ($price - (($off->value / 100) * $price)) : $price;
        return round(($pp+($data['gratuity']??0)) + (($pp+($data['gratuity']??0)) * $share_setting->tax), 2);
    }

}
