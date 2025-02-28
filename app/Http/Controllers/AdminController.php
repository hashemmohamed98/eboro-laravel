<?php

namespace App\Http\Controllers;

use App\Chatonline;
use App\Exports\ClassExport;
use App\Exports\ProductExport;
use App\Helper\OrderStatus;
use App\Helper\UploadImages;
use App\Helper\UsersStatus;
use App\Helper\UsersType;
use App\Http\Requests\EditSettingRequest;
use App\Imports\ProductImport;
use App\InnerType;
use App\Models\Branch;
use App\Models\BranchProduct;
use App\Models\BranchStaff;
use App\Models\Category;
use App\Models\Order;
use App\Models\Provider;
use App\Models\Subscriber;
use App\Models\User;
use App\Promocode;
use App\Promouser;
use App\Repository\CommentLikeRepository;
use App\Repository\CommentRepository;
use App\Repository\ContactRepository;
use App\Repository\FavoriteRepository;
use App\Repository\OrderRepository;
use App\Repository\RateRepository;
use App\Repository\SettingRepository;
use App\Repository\TypeRepository;
use App\Services\ApiResponseService;
use App\Setting;
use App\Type;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AdminController extends Controller
{

    protected $SettingRepo;
    protected $ContactRepo;
    protected $orderRepo;
    protected $typeRepo;
    protected $apiResponse;

    public function __construct(TypeRepository $typeRepo, OrderRepository $orderRepo, ApiResponseService $apiResponse, SettingRepository $SettingRepo, ContactRepository $ContactRepo)
    {
        $this->SettingRepo = $SettingRepo;
        $this->ContactRepo = $ContactRepo;
        $this->typeRepo = $typeRepo;
        $this->orderRepo = $orderRepo;
        $this->apiResponse = $apiResponse;

    }

    public function home(Request $request)
    {
        $users = User::get();
        $Branches = Branch::get();
        return view('admin.home', compact('users', 'Branches'));
    }

    public function report(Request $request)
    {
        $Branches = Branch::get();
        $Order = Order::get();
        return view('admin.report', compact('Order', 'Branches'));
    }

    public function promo(Request $request)
    {
        $time = Carbon::now();
        $PromoCodes = Promocode::whereDate('start_at', '<=', $time)
            ->whereDate('end_at', '>=', $time)
            ->get();
        $PromoUsers = Promouser::get();
        $users = User::get();

        return view('admin.promo', compact('PromoCodes', 'PromoUsers', 'users'));

    }

    public function provider_branches($id = null)
    {
        $Providers = Provider::where(["id" => $id])->first();
        $Branches = Branch::where('provider_id', $id)->get();;
        return view('admin.Branches', compact('Branches', 'Providers'));
    }

    public function delivery(Request $request)
    {
        $users = User::where('type', UsersType::Delivery)->get();
        $Branches = Branch::get();
        return view('admin.delivery', compact('users', 'Branches'));
    }

    public function update_orders_chat($id = null)
    {
        $Chatonlines = Chatonline::where(['order_id' => $id, 'view' => '0','type' => 'user'])->get();
        Chatonline::where('order_id', $id)->update(['view' => '1']);
        //return view('admin.chat', compact('Chatonlines'));
        return $this->apiResponse->setSuccess(trans('admin.done'))->setData($Chatonlines)->setCode(200)->send();
    }

    public function update_orders_delivery_chat($id = null)
    {
        $Chatonlines = Chatonline::where(['order_id' => $id, 'view' => '0','type' => 'delivery'])->get();
        Chatonline::where('order_id', $id)->update(['view' => '1']);
        //return view('admin.chat', compact('Chatonlines'));
        return $this->apiResponse->setSuccess(trans('admin.done'))->setData($Chatonlines)->setCode(200)->send();
    }

    public function status($id)
    {
        $user = User::find($id);
        if ($user->active == UsersStatus::Active) {
            $data['active'] = UsersStatus::InActive;
        } else {
            $data['active'] = UsersStatus::Active;
        }
        $user->update($data);
        return back()->with('success', trans('admin.updated'));
    }

    public function category(Request $request)
    {
        $Categories = Category::get();
        return view('admin.category', compact('Categories'));
    }

    public function order(Request $request)
    {
        $Orders = Order::latest()->get();
        $Chatonlines = Chatonline::get();
        $Deliveries = User::where(['type' => UsersType::Delivery, 'active' => 1, 'online' => 1])->get();
        $Cashiers = BranchStaff::where('type', UsersType::Cashier)->get();
        $Providers = Provider::get();
        return view('admin.order', compact('Orders', 'Deliveries', 'Cashiers', 'Chatonlines', 'Providers'));
    }

    public function refundOrders(Request $request)
    {
        $Orders = Order::where('status',OrderStatus::refund)->latest()->get();
        $Chatonlines = Chatonline::get();
        $Deliveries = User::where(['type' => UsersType::Delivery, 'active' => 1, 'online' => 1])->get();
        $Cashiers = BranchStaff::where('type', UsersType::Cashier)->get();
        $Providers = Provider::get();
        return view('admin.order', compact('Orders', 'Deliveries', 'Cashiers', 'Chatonlines', 'Providers'));
    }

    public function update_order(Request $request)
    {
        if (isset($request->name)) {
            if (isset($request->start)) {
                $Orders = Order::with('branch')->whereHas('branch.provider', function ($q) use ($request) {
                    $q->where('id', $request->name);
                })
                    ->whereBetween('updated_at', [$request->start, $request->end])
                    ->latest()->get();
            } else {
                $Orders = Order::with('branch')->whereHas('branch.provider', function ($q) use ($request) {
                    $q->where('id', $request->name);
                })
                    ->latest()->get();
            }

        } else if (isset($request->start)) {
            $Orders = Order::whereBetween('updated_at', [$request->start, $request->end])
                ->latest()->get();
        } else {
            $Orders = Order::latest()->get();
        }
        $Chatonlines = Chatonline::get();
        $Deliveries = User::where(['type' => UsersType::Delivery, 'active' => 1, 'online' => 1])->get();
        $Cashiers = BranchStaff::where('type', UsersType::Cashier)->get();
        $Providers = Provider::get();
        return view('admin.update_order', compact('Orders', 'Deliveries', 'Cashiers', 'Chatonlines', 'Providers'));
    }

    public function product(Request $request)
    {
        $Products = BranchProduct::get();
        $Branches = Branch::get();
        $types = InnerType::get();
        return view('admin.product', compact('Products', 'Branches', 'types'));
    }

    public function changeState($id)
    {
        $Setting = $this->SettingRepo->getById($id);
        if ($Setting->state == 'open') {
            $data['state'] = 'close';
        } else {
            $data['state'] = 'open';
        }
        $this->SettingRepo->update($id, $data);
        return back()->with('success', trans('admin.updated'));
    }

    public function State()
    {
        $Setting = $this->SettingRepo->getById(1);
        return $recs =
            [
                'state' => $Setting->state,
                'message' => $Setting->{'state_message_' . app()->getLocale()},
            ];
    }

    public function provider(Request $request)
    {
        $Providers = Provider::get();
        $users = User::get();
        $Categories = Category::get();
        $types = Type::get();
        $InnerTypes = InnerType::get();
        return view('admin.provider', compact('Providers', 'users','InnerTypes', 'Categories', 'types'));
    }

    public function type(Request $request)
    {
        $Categories = Category::get();
        $types = Type::get();
        if($request->filled('id'))
            $types = Type::where('category_id' , $request->get('id'))->get();
        return view('admin.type', compact('types', 'Categories'));
    }

    public function setting(Request $request)
    {
        $setting = Setting::first();
        return view('admin.setting', compact('setting'));
    }

    public function editsetting(Request $request)
    {
        $setting = Setting::first();
        $Products = BranchProduct::get();
        $Providers = Provider::get();
        return view('admin.setting.editSetting', compact('setting', 'Products', 'Providers'));
    }

    public function editsettingphones(Request $request)
    {
        $setting = Setting::first();
        $Products = BranchProduct::get();
        $Providers = Provider::get();
        return view('admin.setting.editSettingPhones', compact('setting', 'Products', 'Providers'));
    }

    public function edit_setting(EditSettingRequest $request, $id)
    {
        $data = $request->except('_token', 'logo', 'slider_image');
        if ($request->logo) {
            $data['logo'] = UploadImages::upload($request->logo, 'setting');
        }
        if ($request->slider_image) {
            $data['slider_image'] = UploadImages::upload($request->slider_image, 'setting',null,null,1600);
        }
        $this->SettingRepo->update($id, $data);
        return redirect()->back();
    }

    public function assist_phones(Request $request,$id)
    {
        // Validate the request, making sure there are 24 phone numbers
        $request->validate([
            'phones' => 'nullable|array|size:24',
            'phones.*' => 'nullable|string', // You can adjust the regex for your needs
        ]);

        // Convert phone numbers to JSON
        $data['assist_phones'] = $request->phones;
        $this->SettingRepo->update($id, $data);


        return redirect()->back()->with('success', 'Phone numbers saved successfully');
    }

    public function subscribe()
    {
        $subscriber = Subscriber::all();
        return view('admin.subscriber', compact('subscriber'));
    }

    public function uploadProductView()
    {
        $Products = BranchProduct::get();
        $Branches = Branch::get();
        $types = Type::get();
        return view('admin.upload_product', compact('Products', 'Branches', 'types'));
    }

    public function download()
    {
        return (new ProductExport())->download('Product.xlsx');
    }

    public function typeID()
    {
        $Branches = Type::select('id','type_it')->get()->toArray();
        return (new ClassExport($Branches))->download('Type.xlsx');
    }
    public function brunchID()
    {
        $types = Branch::select('id','name')->get()->toArray();
        return (new ClassExport($types))->download('Branch.xlsx');
    }

    public function import(Request $request)
    {
        if ($request->hasFile('file'))
        {
                \Maatwebsite\Excel\Facades\Excel::import(new ProductImport(), $request->file);
                return back()->with('success', 'Product Uploaded');
        }
        else
        {
            return back()->with('error', 'please selected the file to upload it');
        }
    }

}


