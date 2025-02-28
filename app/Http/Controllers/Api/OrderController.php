<?php

namespace App\Http\Controllers\Api;


use App\Helper\OrderStatus;
use App\Helper\UsersType;
use App\Http\Controllers\Dashboard\HomeController;
use App\Http\Controllers\SiteController;
use App\Http\Requests\CreateOrderRequest;
use App\Http\Requests\DeleteOrderRequest;
use App\Http\Requests\EditOrderRequest;
use App\Http\Requests\RateOrderRequest;
use App\Http\Requests\SearchOrderRequest;
use App\Http\Resources\DemoOrderRescource;
use App\Http\Resources\OrderRescource;
use App\Mail\InvoiceMail;
use App\Models\Branch;
use App\Models\Order;
use App\Models\OrderLog;
use App\Models\User;
use App\OrderRate;
use App\Repository\BranchProductRepository;
use App\Repository\CartRepository;
use App\Repository\OrderLogRepository;
use App\Repository\OrderprovidersRepository;
use App\Repository\OrderRepository;
use App\Repository\ProductSauceRepository;
use App\Repository\UserRepository;
use App\Services\ApiResponseService;
use App\Http\Controllers\Controller;
use App\Setting;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
    protected $ProductSauceRepo;
    protected $ProductRepo;
    protected $cartRepo;
    protected $orderLogRepo;
    protected $orderRepo;
    protected $apiResponse;
    protected $userRepo;
    protected $ordersRepo;

    public function __construct(UserRepository $userRepo,OrderLogRepository $orderLogRepo,OrderRepository $orderRepo, OrderprovidersRepository $ordersRepo, CartRepository $cartRepo, BranchProductRepository $ProductRepo, ProductSauceRepository $ProductSauceRepo, ApiResponseService $apiResponse)
    {
        $this->ProductSauceRepo = $ProductSauceRepo;
        $this->ProductRepo = $ProductRepo;
        $this->cartRepo = $cartRepo;
        $this->orderLogRepo = $orderLogRepo;
        $this->orderRepo = $orderRepo;
        $this->userRepo = $userRepo;
        $this->apiResponse = $apiResponse;
    }

    public function create(CreateOrderRequest $request)
    {
        $payment = false;
        if (isset($request->flag)) {
            $request->comment = json_decode($request->comment, true);
        }

        if (empty(auth()->user()->mobile)) {
            return  $val = ['link' => $this->apiResponse->setError(['error' => 'there is no mobile for selected user'])->setCode(403)->send(403),];
        }

        $share_setting = Setting::first();
        $cart = $this->cartRepo->with('product', 'sauce')->where('user_id', auth()->id())->get();

        if ($cart->count() == 0) {
            return $this->apiResponse->setError(trans('admin.no_product'))->setCode(400)->send();
        }

        DB::beginTransaction();
        $data = $request->validated();
        $insert = Arr::only($request->validated(), ['drop_lat', 'gratuity','options','comment', 'drop_long', 'drop_address', 'payment', 'user_id', 'ordar_at']);

        if ($request->payment && $request->payment == 1)
        {
            $payment = $this->orderRepo->payment($request->validated());

            if (isset($payment['error']))
                return  $val = ['link' => $this->apiResponse->setError($payment['error'])->setCode(403)->send(403),];
            else
            {
                $insert['transaction_ID'] = $payment;
                $payment = true;
            }


        }
        else if ($request->payment && $request->payment == 2) {
            return  $val = ['link' => $this->orderRepo->handlePayment($request->validated()),];
        }
        else
        {
            $payment = true;
        }
        $nearest = [];
        //  || $request->payment == 0
        if ((isset($payment) && $payment))
        {

            if (count($cart->pluck('product.branch.provider_id')->unique()) == 1)
            {
                $nearestBranch = Branch::select(DB::raw('*, ( 6371 * acos( cos( radians(' .
                    $data['drop_lat'] . ') ) * cos( radians(`lat`) ) * cos(radians(`long`) - radians(' .
                    $data['drop_long'] . ') ) + sin( radians(' . $data['drop_lat'] .
                    ') ) * sin( radians(`lat`) ) ) ) as distance'))
                    ->having('distance', '<=', $Providers->range_delivery??$share_setting->range)
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
                        $data['drop_lat'] . ') ) * cos( radians(`lat`) ) * cos(radians(`long`) - radians(' .
                        $data['drop_long'] . ') ) + sin( radians(' . $data['drop_lat'] .
                        ') ) * sin( radians(`lat`) ) ) ) as distance'))
                        ->having('distance', '<=', $Providers->range_delivery??$share_setting->range)->orderBy('distance')->where('provider_id', $item)->first();

                    if ($nearestBranch != "")
                    {
                        array_push($nearest, $nearestBranch);
                    }
                }
                $insert['branch_id'] = null;
            }

            $Shipping_par  = (SiteController::distance2($data['drop_lat'], $data['drop_long'],"need"));
            $insert['total_price'] = (auth()->user()->carts->sum('price') + ($request->gratuity??0) + ((auth()->user()->carts->sum('price') + ($request->gratuity??0)) * $share_setting->tax) + $Shipping_par["shipping"]);
            $insert['tax_price'] = ((auth()->user()->carts->sum('price') + ($request->gratuity??0)) * $share_setting->tax);
            $insert['shipping_price'] = $Shipping_par["shipping"];
            $insert['Delivery_time'] = $Shipping_par["Duration"] ?? "unknown";
            $insert['Delivery_distance'] = $share_setting->de_start??180 + ($share_setting->de_per_km??30 * $Shipping_par["Distance"]??1);
            $order = $this->orderRepo->create($insert);

            foreach ($nearest as $item)
            {

                $POP = $this->cartRepo->with('product')->whereHas('product.branch',function ($q) use ($item){
                    $q->where(['branch_id'=> $item->id, 'user_id'=> auth()->id()]);
                })->sum('price') + ($request->gratuity??0);

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
                    'sauce_ids' => $item->sauce_ids,
                    'price' => $item->product->price,
                    'comment' => $request->comment[$key]??null,
                    'qty' => $item->qty,
                ]);
            }

            $this->cartRepo->with('product', 'product', 'sauce')->where('user_id', auth()->id())->delete();
            try {
                Mail::to($order->user->email)->send(new InvoiceMail($order));
            }
            catch (\Exception $e) {}
        }
        else
        {
            return  $val = ['link' => $this->apiResponse->setSuccess(trans('admin.payment_error'))->setCode(400)->send(),];
        }
        DB::commit();
        return  $val = ['link' => $this->apiResponse->setSuccess(trans('admin.done'))->setCode(200)->send(),];
    }

    public function search(SearchOrderRequest $request)
    {
        HomeController::update_ordersState();
        $orders = $this->orderRepo->with('user', 'delivery', 'cashier', 'content', 'content.product', 'content.sauce');
        if (isset($request->status)) {
            $orders = $orders->where('status', $request->status);
        }
        if (isset($request->branch_id)) {
            if ($request->branch_id == 'null') {
                $orders = $orders->whereNull('branch_id');
            } else {
                $orders = $orders->with("branches")
                    ->whereHas('branches.branch', function ($q) use ($request) {
                        $q->where('id', $request->branch_id);
                    })
                    ->orwhere("branch_id", $request->branch_id)
                    ->latest();
            }
        }
        if (isset($request->user_id)) {
            $orders = $orders->where('user_id', $request->user_id);
        }
        if (isset($request->delivery_id)) {
            if ($request->delivery_id == 'null') {
                $orders = $orders->whereNull('delivery_id');
            } else {
                $orders = $orders->where('delivery_id', $request->delivery_id);
            }
        }
        if (isset($request->cashier_id)) {
            if ($request->cashier_id == 'null') {
                $orders = $orders->whereNull('cashier_id');
            } else {
                $orders = $orders->where('cashier_id', $request->cashier_id);
            }
        }
        if (isset($request->id)) {
            $orders = $orders->where('id', $request->id);
        }
        $orders = $orders->latest()->get();

        return $this->apiResponse->setData(OrderRescource::collection($orders))->setCode(200)->send();
    }

    public function edit(EditOrderRequest $request)
    {
        $data = Arr::except($request->validated(), 'order_id');
        $orders = $this->orderRepo->where('id', $request->order_id)->first();

        if(!in_array(auth()->user()->type,[UsersType::Delivery,UsersType::Cashier]) &&  $request->status==OrderStatus::refund)
        {
            $order_ref = $this->orderRepo->where(['status'=>OrderStatus::Pending,'id'=>$request->order_id])
                ->whereDate('ordar_at','>', Carbon::now()->subMinute(5))->first();

            if($order_ref)
            {
                $data['status']=$request->status;
                $order = $this->orderRepo->update($request->order_id, $data);
                $this->orderRepo->log($order, 'refund');
            }
            else
            {
                return $this->apiResponse->setError(trans('api.refund'))->setCode(403)->send(403); //error the cancel of order must be in first of 5 minutes from order created
            }
        }

        if(auth()->user()->type == UsersType::Cashier)
            $data['cashier_id'] = auth()->user()->Branch->id;
        if(auth()->user()->type == UsersType::Delivery)
            $data['delivery_id'] = auth()->user()->id;

        if (isset($orders) && $orders->branch_id == null && auth()->user()->type == UsersType::Cashier)
        {

            $orders = $this->ordersRepo->where(['order_id' => $request->order_id, 'branch_id' => auth()->user()->Branch->branch_id]) ->first()->id;
            $this->ordersRepo->update($orders, $data);
            if (count($this->ordersRepo->where(['order_id' => $request->order_id])->whereIn('status' ,[
                    OrderStatus::Pending,
                    OrderStatus::InProgress,
                    OrderStatus::ToDelivering,
                    OrderStatus::onWay,
                    OrderStatus::OnDelivering,
                    OrderStatus::Delivered,
                ])->get()->pluck('status')->unique()) == 1)
            {
                $order = $this->orderRepo->update($request->order_id, $data);
            }
        }
        else
        {
            if(auth()->user()->type == UsersType::Delivery)
            {
                if (
                    $request['status'] == OrderStatus::onWay ||
                    $request['status'] == OrderStatus::OnDelivering ||
                    $request['status'] == OrderStatus::Delivered ||
                    $request['status'] == OrderStatus::UserNotFound ||
                    $request['status'] == OrderStatus::Completed)
                {
                    if($orders->delivery_id != auth()->user()->id)
                        return $this->apiResponse->setError(trans('admin.not_permission'))->setCode(403)->send(403);

                    $order = $this->orderRepo->update($request->order_id, $data);
                    $this->orderRepo->log($order, 'accept');
                }
                elseif ($request['status'] == 'delivery_cancel')
                {
                    $data['status'] = OrderStatus::ToDelivering;
                    $data['delivery_id'] = null;
                    $order = $this->orderRepo->update($request->order_id, $data);
                    $this->orderRepo->log($order, 'cancel');
                }
            }
            else
            {
                $this->orderRepo->update($request->order_id, $data);
            }
        }

        return $this->apiResponse->setData(new OrderRescource($this->orderRepo->where('id', $request->order_id)->first()))->setCode(200)->send();
    }

    public function delete(DeleteOrderRequest $request)
    {
        $orders = $this->orderRepo->where('id', $request->order_id)->first();
        return $this->apiResponse->setSuccess(trans('admin.deleted'))->setCode(200)->send();
    }

    public function rate_order(RateOrderRequest $request)
    {

        $order = Order::where(["id" => $request->order_id])->first();
        if($order)
        {
            $order_rate = OrderRate::where(["order_id" => $request->order_id, "user_id" => auth()->id()])->first();
            if ($order_rate) {
                $order_rate->delete();
            } else {
                $order->rate()->create([
                    'user_id' => auth()->id(),
                    'value' => $request->value,
                    'comment' => $request->comment,
                ]);
            }
        }
        else{
            return $this->apiResponse->setError(trans('admin.not_found'))->setCode(404)->send();
        }

        return $this->apiResponse->setSuccess(trans('admin.done'))->setCode(200)->send();
    }

    public function olderfindDelivery()
    {
        $orders = $this->orderRepo->with('log')
            ->whereIn('status', [OrderStatus::ToDelivering,])
            ->Where("delivery_id", null)
            ->whereDoesntHave('log', function ($qu) {
                $qu->where(['delivery_status' => 'cancel', 'delivery_id' => auth()->id()]);
            })
            ->get();
        $neededOrder = [];

        foreach ($orders as $order)
        {
            if ($order->branch_id == null)
            {
                foreach ($order->branches as $item)
                {
                    $distance = $this->orderRepo->getDistanceBetweenBranches(auth()->user(), Branch::find($item->branch->id));
                    if ($item->branch->provider->range_delivery >= $distance)
                    {
                        array_push($neededOrder, new OrderRescource($order));
                    }
                }
            }
            else
            {
                $distance = $this->orderRepo->getDistanceBetweenBranches(auth()->user(), Branch::find($order->branch_id));

                if ($order->branch->provider->range_delivery >= $distance && $order->branch->provider->delivery == 0)
                {
                    array_push($neededOrder, new OrderRescource($order));//DemoOrderRescource
                }
            }
        }
        return $this->apiResponse->setData($neededOrder)->setCode(200)->send();

        //        foreach ($orders as $order)
//        {
//
//            $users = User::where(['type' => UsersType::Delivery, 'online' => 1])->whereDoesntHave('cashierBranch')->get();
//            $dist = null;
//            $neededUser = null;
//            $distance = null;
//            foreach ($users as $user)
//            {
//                if($order->branch_id == null)
//                {
//                    foreach ($order->branches as $item)
//                    {
//                        $distance =  $this->orderRepo->getDistanceBetweenBranches($user, Branch::find($item->branch->id));
//                        if ($dist == null || $distance < $dist) {
//                            $dist = $distance;
//                            $neededUser = $user;
//                            if ($neededUser->id == auth()->id()&& $order->status == OrderStatus::ToDelivering) {
//                                array_push($neededOrder,new OrderRescource($order));
//                            }
//                        }
//                    }
//                }
//                else
//                {
//                    $distance = $this->orderRepo->getDistanceBetweenBranches($user, Branch::find($order->branch_id));
//                    if ($dist == null || $distance < $dist)
//                    {
//                        $dist = $distance;
//                        $neededUser = $user;
//                        if ($neededUser->id == auth()->id()&& $order->status == OrderStatus::ToDelivering)
//                        {
//                            array_push($neededOrder,new OrderRescource($order));
//                        }
//                    }
//                }
//            }
//        }
    }

    public function oldfindDelivery()
    {
        $neededOrder = [];

        //////////////////////////////////////////////
        // no rider allowed to have 2 orders in same time
        //////////////////////////////////////////////
        $Check = $this->orderRepo
            ->whereIn('status', [OrderStatus::onWay,OrderStatus::OnDelivering,OrderStatus::Delivered])
            ->Where("delivery_id", auth()->id())->get();

        if(isset($Check) && count($Check) < 0)
            return $this->apiResponse->setData($neededOrder)->setError('no rider allowed to have 2 orders in same time')->setCode(200)->send();
        //////////////////////////////////////////////

        //////////////////////////////////////////////
        // Get All orders
        //////////////////////////////////////////////
        $orders = $this->orderRepo->with('log')
            ->Where(['status'=>OrderStatus::ToDelivering , "delivery_id"=> null])
            ->whereDoesntHave('log', function ($qu){
                $qu->where('delivery_status','notactive');
                $qu->where('updated_at', '>=', Carbon::now()->subMinutes(1)->toDateTimeString());
            })->get();

        if(isset($orders) && count($orders) < 0)
            return $this->apiResponse->setData($neededOrder)->setError('No order')->setCode(200)->send();
        //////////////////////////////////////////////

        foreach ($orders as $order)
        {


            //////////////////////////////////////////////
            // Delete log if there is`t rider online for more than 3 min
            //////////////////////////////////////////////
            $Logs = $this->orderLogRepo
                ->where('order_id', $order->id)
                ->where('updated_at', '<', Carbon::now()->subMinutes(3)->toDateTimeString())
                ->get();

            if(isset($Logs) && count($Logs) > 0)
                $this->orderLogRepo->where('order_id', $order->id)->delete();
            //////////////////////////////////////////////

            //////////////////////////////////////////////
            // Make order Refund if no rider in 25 min
            //////////////////////////////////////////////
            $checkLog = $this->orderRepo
                ->where(['id'=> $order->id ,'status' => OrderStatus::ToDelivering])
                ->whereDate('updated_at', '>=', Carbon::now()->subMinutes(25)->toDateTimeString())->first();

            if(isset($checkLog) && $checkLog != null)
            {
                $data['status'] = OrderStatus::refund;
                $order = $this->orderRepo->update($order->id, $data);
            }
            //////////////////////////////////////////////

            $users = User::with('log')
                ->where([
                    'type' => UsersType::Delivery,
                    'online' => 1
                ])->whereDoesntHave('log', function ($qu) use ($order) {
                    $qu->where([
                        'order_id' => $order->id ,
                        'delivery_status'=>'notactive'
                    ]);//'cancel',
                    $qu->where('updated_at', '>=', Carbon::now()->subMinutes(2)->toDateTimeString());
                })->get();

            if($order->branch_id == null)
            {
                foreach ($order->branches as $item)
                {
                    $User =  $this->orderRepo->getNearestDel($users, Branch::find($item->branch->id));
                    if (isset($User) &&  $User->id == auth()->id()) {
                        array_push($neededOrder,new OrderRescource($order));
                        $this->orderRepo->Setlog($order , $User->id ,'notactive');
                    }
                }
            }
            else
            {
                $User =  $this->orderRepo->getNearestDel($users, Branch::find($order->branch_id));
                if (isset($User) && $User->id == auth()->id())
                {
                    array_push($neededOrder,new OrderRescource($order));
                    $this->orderRepo->Setlog($order , $User->id ,'notactive');
                }
            }
        }
        return $this->apiResponse->setData($neededOrder)->setCode(200)->send();
    }

    public function findDelivery()
    {
        $neededOrder = [];
        //////////////////////////////////////////////
        //  last_session
        //////////////////////////////////////////////
        $this->orderRepo->SetDeliveryState();
        //////////////////////////////////////////////
        // no rider allowed to have 2 orders in same time
        //////////////////////////////////////////////
        $Check = $this->orderRepo
            ->whereIn('status', [OrderStatus::onWay,OrderStatus::OnDelivering,OrderStatus::Delivered])
            ->Where("delivery_id", auth()->id())->get();

        if(isset($Check) && count($Check) < 0)
            return $this->apiResponse->setData($neededOrder)->setError('no rider allowed to have 2 orders in same time')->setCode(200)->send();
        //////////////////////////////////////////////

        //////////////////////////////////////////////
        // Get All orders
        //////////////////////////////////////////////
        $orders = $this->orderRepo->with('log')
            ->Where(['status'=>OrderStatus::ToDelivering , "delivery_id"=> null])
            ->whereDoesntHave('log', function ($qu){
                $qu->where('delivery_status','notactive');
                $qu->where('updated_at', '>=', Carbon::now()->subMinutes(1)->toDateTimeString());
            })->whereDoesntHave('log', function ($qu){
                $qu->where('delivery_status','notactive');
                $qu->where('delivery_id',auth()->id());
                $qu->where('updated_at', '>=', Carbon::now()->subMinutes(2)->toDateTimeString());
            })->get();

        if(isset($orders) && count($orders) < 0)
            return $this->apiResponse->setData($neededOrder)->setError('No order')->setCode(200)->send();
        //////////////////////////////////////////////

        foreach ($orders as $order)
        {
            if($order->branch_id == null)
            {
                foreach ($order->branches as $item)
                {
                    $flag =  $this->orderRepo->isInRange($item->branch->provider->range_delivery,Branch::find($item->branch->id));
                    if ($flag) {
                        array_push($neededOrder,new OrderRescource($order));
                        $this->orderRepo->Setlog($order , auth()->id() ,'notactive');

                    }
                }
            }
            else
            {
                $flag =  $this->orderRepo->isInRange($order->branch->provider->range_delivery,Branch::find($order->branch_id));
                if ($flag) {
                    array_push($neededOrder,new OrderRescource($order));
                    $this->orderRepo->Setlog($order , auth()->id() ,'notactive');
                }
            }
        }
        return $this->apiResponse->setData($neededOrder)->setCode(200)->send();
    }

}
