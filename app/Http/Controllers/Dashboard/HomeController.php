<?php

namespace App\Http\Controllers\Dashboard;

use App\Helper\OrderStatus;
use App\Helper\UploadImages;
use App\Helper\UsersType;
use App\Http\Controllers\SiteController;
use App\Http\Requests\EditOrderRequest;
use App\InnerType;
use App\Mealoffer;
use App\Models\Branch;
use App\Models\BranchProduct;
use App\Models\BranchStaff;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Favorite;
use App\Models\Order;
use App\Models\ProductSauce;
use App\Models\Provider;
use App\Models\Rate;
use App\Models\Testmonial;
use App\Offer;
use App\Repository\BranchProductRepository;
use App\Http\Controllers\Controller;
use App\Repository\BranchRepository;
use App\Repository\BranchStaffRepository;
use App\Repository\CategoryRepository;
use App\Repository\InnerTypeRepository;
use App\Repository\OrderprovidersRepository;
use App\Repository\OrderRepository;
use App\Repository\ProductSauceRepository;
use App\Repository\ProviderRepository;
use App\Repository\TypeRepository;
use App\Type;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;

class HomeController extends Controller
{

    protected $BranchProduct,$BranchStaff,$Branch,$Category,$ProductSauce,$Provider,$orderRepo,$typeRepo,$innertypeRepo,$ordersRepo;
    public function __construct(BranchProductRepository $BranchProduct,BranchStaffRepository $BranchStaff,
                                BranchRepository $Branch,
                                CategoryRepository $Category,
                                ProductSauceRepository $ProductSauce,
                                OrderRepository $orderRepo,
                                TypeRepository $typeRepo,
                                InnerTypeRepository $innertypeRepo,
                                OrderprovidersRepository $ordersRepo,
                                ProviderRepository $Provider)
    {
        $this->BranchProduct = $BranchProduct;
        $this->BranchStaff = $BranchStaff;
        $this->Branch = $Branch;
        $this->Category = $Category;
        $this->ProductSauce = $ProductSauce;
        $this->Provider = $Provider;
        $this->orderRepo = $orderRepo;
        $this->typeRepo = $typeRepo;
        $this->innertypeRepo = $innertypeRepo;
        $this->ordersRepo = $ordersRepo;
    }

    public function index($name)
    {

        return view('dashboard.pages.home', $this::GData($name));
    }

    public function Orders($name)
    {
        return view('dashboard.pages.order', $this::GData($name));
    }
    public function update_orders($name)
    {
        return view('dashboard.pages.update_order', $this::GData($name));
    }

    static function update_ordersState()
    {
        Order::where('status',OrderStatus::Pending)
            ->where('ordar_at','<', Carbon::now()->subMinutes(120)->toDateTimeString())
            ->update(['status'=> OrderStatus::refund,'refuse_reason'=>'The restaurant does not answer']);

        Order::whereIn('status',[OrderStatus::OnDelivering,OrderStatus::onWay])
            ->where('ordar_at','<', Carbon::now()->subMinutes(120)->toDateTimeString())
            ->update(['status'=> OrderStatus::interrupt,'refuse_reason'=>'The delivery man does`nt change order state after long time']);
    }


    public function add_type(Request $request)
    {
        $data = $request->except('_token' , 'image');
        if ($request->image) {
            $data['image'] = UploadImages::upload($request->image, 'Types');
        }
        $this->typeRepo->create($data);
        return back()->with('success', trans('admin.add'));
    }


    public function add_inner_types(Request $request)
    {
        $data = $request->except('_token' , 'image');
        if ($request->image) {
            $data['image'] = UploadImages::upload($request->image, 'Types');
        }
        $this->innertypeRepo->create($data);
        return back()->with('success', trans('admin.add'));
    }
    public function change_inner_types(Request $request,$id)
    {
        $type = $this->innertypeRepo->getById($id);

        $data = $request->except('_token' , 'image');
        if ($request->image) {
            $old = $type->image ? public_path('uploads/Types/' . $type->image) : '';
            $data['image'] = UploadImages::upload($request->image, 'Types', $old);
        }
        $this->innertypeRepo->update($id,$data);
        return back()->with('success', trans('admin.updated'));
    }

    public function change_type(Request $request,$id)
    {
        $type = $this->typeRepo->getById($id);

        $data = $request->except('_token' , 'image');
        if ($request->image) {
            $old = $type->image ? public_path('uploads/Types/' . $type->image) : '';
            $data['image'] = UploadImages::upload($request->image, 'Types', $old);
        }
        $this->typeRepo->update($id,$data);
        return back()->with('success', trans('admin.updated'));
    }
    public function delete_inner_types($id)
    {
        $type = $this->innertypeRepo->getById($id);
        if($type->image)
        {
            $old = $type->image ? public_path('uploads/Types/' . $type->image) : null;
            if ($old) {
                unlink($old);
            }
        }
        $this->innertypeRepo->delete($id);
        return back()->with('success', trans('admin.updated'));
    }

    public function delete_type($id)
    {
        $type = $this->typeRepo->getById($id);
        if($type->image)
        {
            $old = $type->image ? public_path('uploads/Types/' . $type->image) : null;
            if ($old) {
                unlink($old);
            }
        }
        $this->typeRepo->delete($id);
        return back()->with('success', trans('admin.updated'));
    }

    public function update_time($name, Request $request)
    {
        Provider::where('name',$name)
            ->update(['duration'=> $request->duration]);

        return redirect()->back();
    }

    public function cashers($name)
    {
        return view('dashboard.pages.cashers', $this::GData($name));
    }

    public function resturant($name)
    {

        return view('dashboard.pages.resturant', $this::GData($name));
    }

    public function get_type($name)
    {
        return view('dashboard.pages.inner_types', $this::GData($name));
    }

    public function client($name)
    {
        return view('dashboard.pages.client', $this::GData($name));
    }

    public function delivery($name)
    {
        return view('dashboard.pages.delivery', $this::GData($name));
    }

    public function sauce($name)
    {
        return view('dashboard.pages.sauce', $this::GData($name));
    }

    public function beveraged($name)
    {
        return view('dashboard.pages.beveraged', $this::GData($name));
    }

    public function edit_order(EditOrderRequest $request){
        $data = Arr::except($request->validated(), 'order_id');

        $orders = $this->orderRepo->where('id',$request->order_id)->first();

        if(isset($orders) && $orders->branch_id == null && auth()->user()->type == "3")
        {
            $orders = $this->ordersRepo->where(['order_id'=>$request->order_id,'branch_id'=> auth()->user()->Branch->branch_id])->first()->id;
            $this->ordersRepo->update($orders, $data);
            if(count($this->ordersRepo->where(['order_id'=>$request->order_id])->get()->pluck('status')->unique()) == 1)
            {
                $order = $this->orderRepo->update($request->order_id, $data);
            }
        }
        else
        {
            $order = $this->orderRepo->update($request->order_id, $data);
        }

        $this->orderRepo->update($request['order_id'],$data);
        return redirect()->back()->withErrors($request->validated())
            ->withInput();
    }


    public function add_sauce($id, Request $request)
    {
        $sauces = ProductSauce::where(['product_id' => $id])->get();
        foreach ($sauces as $item)
        {$this->ProductSauce->delete($item->id);}
        if($request['sauce_id'])
        {foreach ($request['sauce_id'] as $item)
        {
            $data = [];
            $data['sauce_id'] = $item;
            $data['product_id'] = $id;
            $this->ProductSauce->create($data);
        }}
        return redirect()->back();
    }

    public static function GData($name)
    {
        $user = Auth::user();
        $Token = 'Bearer '.JWTAuth::fromUser($user);
        $time = Carbon::now();
        $offers = Offer::whereDate('start_at','<=', $time)
            ->whereDate('end_at','>=', $time)
            ->get();

        $meal_offers = Mealoffer::whereDate('start_at','<=', $time)
            ->whereDate('end_at','>=', $time)
            ->get();
        if(Auth::user()->type ==3 || Auth::user()->type ==4)
        {
            $Providers = Provider::where(['name' => $name])->first();
        }
        else
        {
            $Providers = Provider::where(["user_id" => Auth::user()->id , 'name' => $name])->first();
        }

        $Branches = Branch::where(["provider_id" => $Providers->id])->get();
        $Orders = Order::with("branches")
            ->whereHas('branches.branch', function($q)use ($Branches) { $q->whereIn('id',  $Branches->pluck('id')->toArray());})
            ->orWhereIn("branch_id" , $Branches->pluck('id')->toArray())
            ->latest()
            ->get();

        $types = InnerType::where('provider_id' , $Providers->id)->get();
        $items = BranchProduct::whereIn("branch_id" , $Branches->pluck('id')->toArray())->where(["product_type" => "Food"])->get();
        $Products = BranchProduct::whereIn("branch_id" , $Branches->pluck('id')->toArray())->where(["product_type" => "Food"])->get();
        $Sauces = BranchProduct::whereIn("branch_id" , $Branches->pluck('id')->toArray())->where(["product_type" => "Sauce"])->get();
        $Additions = BranchProduct::whereIn("branch_id" , $Branches->pluck('id')->toArray())->where(["product_type" => "Addition"])->get();
        $Admins = BranchStaff::whereIn("branch_id" , $Branches->pluck('id')->toArray())->where(["type" => UsersType::Cashier])->get();
        $Deliveries = BranchStaff::whereIn("branch_id" , $Branches->pluck('id')->toArray())->where(["type" => UsersType::Delivery])->get();
        $Cashiers = BranchStaff::whereIn("branch_id" , $Branches->pluck('id')->toArray())->where(["type" => UsersType::Cashier])->get();
        $Favorites = Favorite::where(["provider_id" => $Providers->id])->orderBy('created_at', 'DESC')->get();
        $Rates = Rate::where(["provider_id" => $Providers->id])->orderBy('created_at', 'DESC')->get();
        $Comments = Comment::whereIn("product_id" , $items->pluck('id')->toArray())->orderBy('created_at', 'DESC')->get();
        $inner_types = InnerType::where('provider_id' , $Providers->id)->get();
        return compact('Products','inner_types','items' , 'Sauces' , 'Additions' , 'Token' ,'Providers' , 'Branches', 'Admins', 'Cashiers', 'Deliveries','Orders','Favorites','Rates','Comments','name' ,'offers' ,'meal_offers','types');
    }

}
