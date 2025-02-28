<?php

namespace App\Http\Controllers;

use App\Helper\UploadImages;
use App\Helper\UsersStatus;
use App\Helper\UsersType;
use App\Http\Requests\CreateBranchStaffRequest;
use App\Http\Requests\DeliveryRegisterRequest;
use App\Http\Requests\DownloadReportRequest;
use App\Http\Requests\SubscribeRequest;
use App\Http\Resources\BranchRescource;
use App\Http\Resources\OfferRescource;
use App\Mealoffer;
use App\Models\Branch;
use App\Models\BranchProduct;
use App\Models\BranchStaff;
use App\Models\CommentLike;
use App\Models\Order;
use App\Models\ProductSauce;
use App\Models\Rate;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Provider;
use App\Models\Subscriber;
use App\Models\Testmonial;
use App\Models\User;
use App\Offer;
use App\Ordermultipleprovider;
use App\ProviderType;
use App\Repository\BranchProductRepository;
use App\Repository\MealofferRepository;
use App\Repository\OfferRepository;
use App\Repository\ProviderRepository;
use App\Repository\RateRepository;
use App\Repository\SettingRepository;
use App\Services\ApiResponseService;
use App\Setting;
use App\Type;
use Carbon\Carbon;
use Faker\Provider\DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Tymon\JWTAuth\Facades\JWTAuth;
use ExcelReport;
use CSVReport;
use PdfReport;

class ReportController extends Controller
{

    protected $providerRepo;
    protected $RateRepo;
    protected $SettingRepo;
    protected $apiResponse;

    public function __construct(SettingRepository $SettingRepo,ProviderRepository $providerRepo, ApiResponseService $apiResponse,RateRepository $RateRepo)
    {
        $this->providerRepo = $providerRepo;
        $this->RateRepo = $RateRepo;
        $this->SettingRepo = $SettingRepo;
        $this->apiResponse = $apiResponse;
    }
    public function index()
    {
        $tests = Testmonial::all();
        return view('site.pages.home', $this::GData())->with(compact('tests'));
    }


    public function Orders_Report($ID,$type,$from_date,$to_date)
    {
        $fromDate = Carbon::parse($from_date);
        $toDate = Carbon::parse($to_date);
        $sortBy = 'ordar_at';

        $title = 'Orders Report';

        $meta = [
            'Orders on' => $fromDate . ' To ' . $toDate,
            'Sort By' => $sortBy
        ];


        $queryBuilder = Order::whereBetween('created_at', [$fromDate, $toDate])
            ->where('branch_id',auth()->user()->Branch->branch_id??$ID)->orderBy($sortBy);

        $columns = [
            'Name' => function($result) {
                return $result->user->name;
            },
            'Address' => function($result) {
                return $result->drop_address;
            },
            'Branch' => function($result) {
                return $result->branch->name??' ';
            },
            'Total Price' => function($result) {
                return ($result->total_price??' ');
            },
            'status' => function($result) {
                return $result->status??' ';
            },
            'delivery' => function($result) {
                return $result->delivery->name??' ';
            },
            'cashier' => function($result) {
                return $result->cashier->user->name??' ';
            },
            'Refuse Reason' => function($result) {
                return $result->refuse_reason??' ';
            },
            'ordar_at',
            'created_at',
            'updated_at',
        ];

        if($type=='excel')
        {
            return ExcelReport::of($title, $meta, $queryBuilder, $columns)
                ->showTotal(['Total Price'=> '€',])->download('Orders_Report'.sha1(random_int(1, 5000) * (float)microtime()));
        }
        else if($type=='csv')
        {
            return CSVReport::of($title, $meta, $queryBuilder, $columns)
                ->showTotal(['Total Price'=> '€',])->download('Orders_Report'.sha1(random_int(1, 5000) * (float)microtime()));
        }
        else if($type=='pdf')
        {
            return PdfReport::of($title, $meta, $queryBuilder, $columns)
                ->showTotal(['Total Price'=> '€',])->download('Orders_Report'.sha1(random_int(1, 5000) * (float)microtime()));
        }

    }
    public function Products_Report($ID,$type,$from_date,$to_date)
    {
        $fromDate = Carbon::parse($from_date);
        $toDate = Carbon::parse($to_date);
        $sortBy = 'created_at';

        $title = 'Products Report';

        $meta = [
            'Products on' => $fromDate . ' To ' . $toDate,
            'Sort By' => $sortBy
        ];


        $queryBuilder = BranchProduct::whereBetween('created_at', [$fromDate, $toDate])
            ->where('branch_id',auth()->user()->Branch->branch_id??$ID)->orderBy($sortBy);

        $columns = [
            'Name' => function($result) {
                return $result->name;
            },
            'Branch' => function($result) {
                return $result->branch->name??' ';
            },
            'Price' => function($result) {
                return ($result->price);
            },
            'type' => function($result) {
                return ($result->type);
            },
            'Additions' => function($result) {
                return $result->additions;
            },
            'out_of_stock' => function($result) {
                return $result->has_outofstock == 1 ? "Yes":"No";
            },
            'Alcohol' => function($result) {
                return $result->has_alcohol == 1 ? "Yes":"No";
            },
            'Pig' => function($result) {
                return $result->has_pig == 1 ? "Yes":"No";
            },
            'created_at',
            'updated_at',
        ];

        if($type=='excel')
        {
            return ExcelReport::of($title, $meta, $queryBuilder, $columns)
                ->download('Products_Report'.sha1(random_int(1, 5000) * (float)microtime()));
        }
        else if($type=='csv')
        {
            return CSVReport::of($title, $meta, $queryBuilder, $columns)
                ->download('Products_Report'.sha1(random_int(1, 5000) * (float)microtime()));
        }
        else if($type=='pdf')
        {
            return PdfReport::of($title, $meta, $queryBuilder, $columns)
                ->download('Products_Report'.sha1(random_int(1, 5000) * (float)microtime()));
        }
    }
    public function Branches_Report($ID,$type,$from_date,$to_date)
    {
        $fromDate = Carbon::parse($from_date);
        $toDate = Carbon::parse($to_date);
        $sortBy = 'created_at';

        $title = 'Branch Report';

        $meta = [
            'Branch on' => $fromDate . ' To ' . $toDate,
            'Sort By' => $sortBy
        ];



        $queryBuilder = Branch::whereBetween('created_at', [$fromDate, $toDate])
            ->where('id',auth()->user()->Branch->branch_id??$ID)->orderBy($sortBy);


        $columns = [
            'Name' => function($result) {
                return $result->name;
            },
            'Address' => function($result) {
                return $result->address;
            },
            'Hot Line' => function($result) {
                return $result->hot_line;
            },
            'Provider' => function($result) {
                return ($result->provider->name);
            },
            'created_at',
            'updated_at',
        ];

        if($type=='excel')
        {
            return ExcelReport::of($title, $meta, $queryBuilder, $columns)
                ->download('Branchs_Report'.sha1(random_int(1, 5000) * (float)microtime()));
        }
        else if($type=='csv')
        {
            return CSVReport::of($title, $meta, $queryBuilder, $columns)
                ->download('Branchs_Report'.sha1(random_int(1, 5000) * (float)microtime()));
        }
        else if($type=='pdf')
        {
            return PdfReport::of($title, $meta, $queryBuilder, $columns)
                ->download('Branchs_Report'.sha1(random_int(1, 5000) * (float)microtime()));
        }
    }
    public function Cashier_Report($ID,$type,$from_date,$to_date)
    {
        $fromDate = Carbon::parse($from_date);
        $toDate = Carbon::parse($to_date);
        $sortBy = 'created_at';

        $title = 'Cashier Report';

        $meta = [
            'Cashier on' => $fromDate . ' To ' . $toDate,
            'Sort By' => $sortBy
        ];



        $queryBuilder = BranchStaff::whereBetween('created_at', [$fromDate, $toDate])
            ->where('branch_id',auth()->user()->Branch->branch_id??$ID)
            ->where('type',3)
            ->orderBy($sortBy);


        $columns = [
            'Name' => function($result) {
                return $result->user->name;
            },
            'Email' => function($result) {
                return $result->user->email;
            },
            'Address' => function($result) {
                return $result->user->address;
            },
            'Mobile' => function($result) {
                return $result->user->mobile;
            },
            'Active' => function($result) {
                return $result->user->active=='1'? "Active" : "Not Active";
            },
            'branch' => function($result) {
                return ($result->branch->name);
            },
            'created_at',
            'updated_at',
        ];

        if($type=='excel')
        {
            return ExcelReport::of($title, $meta, $queryBuilder, $columns)
                ->download('Cashier_Report'.sha1(random_int(1, 5000) * (float)microtime()));
        }
        else if($type=='csv')
        {
            return CSVReport::of($title, $meta, $queryBuilder, $columns)
                ->download('Cashier_Report'.sha1(random_int(1, 5000) * (float)microtime()));
        }
        else if($type=='pdf')
        {
            return PdfReport::of($title, $meta, $queryBuilder, $columns)
                ->download('Cashier_Report'.sha1(random_int(1, 5000) * (float)microtime()));
        }
    }
    public function Delivery_Report($ID,$type,$from_date,$to_date)
    {
        $fromDate = Carbon::parse($from_date);
        $toDate = Carbon::parse($to_date);
        $sortBy = 'created_at';

        $title = 'Delivery Report';

        $meta = [
            'Delivery on' => $fromDate . ' To ' . $toDate,
            'Sort By' => $sortBy
        ];


        $queryBuilder = BranchStaff::whereBetween('created_at', [$fromDate, $toDate])
            ->where('branch_id',auth()->user()->Branch->branch_id??$ID)
            ->where('type',4)
            ->orderBy($sortBy);


        $columns = [
            'Name' => function($result) {
                return $result->user->name;
            },
            'Email' => function($result) {
                return $result->user->email;
            },
            'Address' => function($result) {
                return $result->user->address;
            },
            'Mobile' => function($result) {
                return $result->user->mobile;
            },
            'Active' => function($result) {
                return $result->user->active=='1'? "Active" : "Not Active";
            },
            'branch' => function($result) {
                return ($result->branch->name);
            },
            'created_at',
            'updated_at',
        ];

        if($type=='excel')
        {
            return ExcelReport::of($title, $meta, $queryBuilder, $columns)
                ->download('Delivery_Report'.sha1(random_int(1, 5000) * (float)microtime()));
        }
        else if($type=='csv')
        {
            return CSVReport::of($title, $meta, $queryBuilder, $columns)
                ->download('Delivery_Report'.sha1(random_int(1, 5000) * (float)microtime()));
        }
        else if($type=='pdf')
        {
            return PdfReport::of($title, $meta, $queryBuilder, $columns)
                ->download('Delivery_Report'.sha1(random_int(1, 5000) * (float)microtime()));
        }
    }
    public function Delivery_Orders_Report($ID,$type,$from_date,$to_date)
    {
        $fromDate = Carbon::parse($from_date);
        $toDate = Carbon::parse($to_date);
        $sortBy = 'ordar_at';

        $title = 'Orders Report';

        $meta = [
            'Orders on' => $fromDate . ' To ' . $toDate,
            'Sort By' => $sortBy
        ];


        $queryBuilder = Order::whereBetween('created_at', [$fromDate, $toDate])
        ->where('delivery_id',auth()->user()->id??$ID)
        ->orderBy($sortBy);

        $columns = [
            'Name' => function($result) {
                return $result->user->name;
            },
            'Address' => function($result) {
                return $result->drop_address;
            },
            'Branch' => function($result) {
                return $result->branch->name??' ';
            },
            'Delivery Price' => function($result) {
                return (number_format( (float) ($result->Delivery_distance / 100), 2, '.', '')??' ');
            },
            'status' => function($result) {
                return $result->status??' ';
            },
            'delivery' => function($result) {
                return $result->delivery->name??' ';
            },
            'cashier' => function($result) {
                return $result->cashier->user->name??' ';
            },
            'Refuse Reason' => function($result) {
                return $result->refuse_reason??' ';
            },
            'ordar_at',
            'created_at',
            'updated_at',
        ];

        if($type=='excel')
        {
            return ExcelReport::of($title, $meta, $queryBuilder, $columns)
                ->showTotal(['Delivery Price'=> '€',])->download('Orders_Report'.sha1(random_int(1, 5000) * (float)microtime()));
        }
        else if($type=='csv')
        {
            return CSVReport::of($title, $meta, $queryBuilder, $columns)
                ->showTotal(['Delivery Price'=> '€',])->download('Orders_Report'.sha1(random_int(1, 5000) * (float)microtime()));
        }
        else if($type=='pdf')
        {
            return PdfReport::of($title, $meta, $queryBuilder, $columns)
                ->showTotal(['Delivery Price'=> '€',])->download('Orders_Report'.sha1(random_int(1, 5000) * (float)microtime()));
        }
    }


    public function Admin_Delivery_Orders_Report(DownloadReportRequest $request)
    {
        $fromDate = Carbon::parse($request->start_date);
        $toDate = Carbon::parse($request->end_date);
        $sortBy = 'ordar_at';
        $title = 'Orders Report';

        $meta = [
            'Orders on' => $fromDate . ' To ' . $toDate,
            'Sort By' => $sortBy
        ];

        if($request->user_id != null)
        {
            $queryBuilder = Order::whereBetween('created_at', [$fromDate, $toDate])
                ->where(['delivery_id'=>$request->user_id,'status'=>'complete'])->orderBy($sortBy);
        }else{
            $queryBuilder = Order::whereBetween('created_at', [$fromDate, $toDate])
                ->whereNotNull('delivery_id')->where(['status'=>'complete'])->orderBy($sortBy);
        }


        $columns = [
            'Name' => function($result) {
                return $result->user->name;
            },
            'Address' => function($result) {
                return $result->drop_address;
            },
            'Branch' => function($result) {
                return $result->branch->name??' ';
            },
            'Delivery Price' => function($result) {
                return (number_format( (float) ($result->Delivery_distance / 100), 2, '.', '')??' ');
            },
            'status' => function($result) {
                return $result->status??' ';
            },
            'delivery' => function($result) {
                return $result->delivery->name??' ';
            },
            'cashier' => function($result) {
                return $result->cashier->user->name??' ';
            },
            'Refuse Reason' => function($result) {
                return $result->refuse_reason??' ';
            },
            'ordar_at',
            'created_at',
            'updated_at',
        ];

        if($request->type=='excel')
        {
            return ExcelReport::of($title, $meta, $queryBuilder, $columns)
                ->showTotal(['Delivery Price'=> '€',])->download('Orders_Report'.sha1(random_int(1, 5000) * (float)microtime()));
        }
        else if($request->type=='csv')
        {
            return CSVReport::of($title, $meta, $queryBuilder, $columns)
                ->showTotal(['Delivery Price'=> '€',])->download('Orders_Report'.sha1(random_int(1, 5000) * (float)microtime()));
        }
        else if($request->type=='pdf')
        {
            return PdfReport::of($title, $meta, $queryBuilder, $columns)
                ->showTotal(['Delivery Price'=> '€',])->download('Orders_Report'.sha1(random_int(1, 5000) * (float)microtime()));
        }
    }


}
