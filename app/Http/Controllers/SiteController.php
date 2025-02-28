<?php

namespace App\Http\Controllers;

use App\Helper\OrderStatus;
use App\Helper\UploadImages;
use App\Helper\UsersStatus;
use App\Helper\UsersType;
use App\Http\Requests\DeliveryRegisterRequest;
use App\Http\Requests\SubscribeRequest;
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
use App\ProviderType;
use App\Repository\ProviderRepository;
use App\Repository\RateRepository;
use App\Repository\SettingRepository;
use App\Services\ApiResponseService;
use App\Setting;
use App\Type;
use Carbon\Carbon;

use Dompdf\Exception;
use GeoTimeZone\Calculator;
use GeoTimeZone\UpdaterData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use phpDocumentor\Reflection\Types\This;
use Tymon\JWTAuth\Facades\JWTAuth;

class SiteController extends Controller
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

    public function Profile(Request $request)
    {
        return view('site.pages.name-profile', $this::GData());
    }

    public function cart()
    {
        return view('site.pages.cart', $this::GData());
    }

    public function aboutus()
    {
        return view('site.pages.aboutus', $this::GData());
    }

    public function contactus()
    {
        return view('site.pages.contact', $this::GData());
    }

    public function privacy()
    {
        return view('site.pages.privacy', $this::GData());
    }

    public function redirect_applications()
    {
        return view('site.pages.applications', $this::GData());
    }

    public function checkout()
    {
        if(auth()->user() && count(auth()->user()->carts) > 0)
        {
            return view('site.pages.checkout', $this::GData());
        }
        else
        {
            $tests = Testmonial::all();
            return redirect('/');
        }

    }

    public function search(Request $request)
    {
        $items = [];
        if ($request->search) {
            $items = Branch::with('provider', 'provider.category')->where('name', 'like', '%' . $request->search . '%')->get();
        }
        return view('site.pages.search', $this::GData())->with(compact('items'));
    }

    public function allCategory(Request $request, $id, $name)
    {
        $Providers = Provider::where(["category_id" => $id,'lock' => 'unlock'])->get();
        $types = Type::where(["category_id" => $id])->get();
        return view('site.pages.our-partners', $this::GData())->with((compact('Providers','types')));
    }

    public function WebFilter(Request $request, $id)
    {
        $providers = $this->providerRepo->with('branch','branch.provider','Rates' , 'branch.Product')->where(["category_id" => $id]);
        $time = Carbon::now();
        if($request['type'])
        {
            foreach ($request['type'] as $item)
            {
                if($item == "Near_Me")
                {
                    $providers = $providers->whereHas('branch',function ($q) use ($request){
                        $q->select(DB::raw('*, ( 6371 * acos( cos( radians(' .
                            (auth()->user()->lat ?? 0) . ') ) * cos( radians(`lat`) ) * cos(radians(`long`) - radians(' .
                            (auth()->user()->long ?? 0) . ') ) + sin( radians(' . (auth()->user()->lat ?? 0) .
                            ') ) * sin( radians(`lat`) ) ) ) as distance'))
                            ->having('distance', '<=', DB::raw('`range_delivery`'))->orderBy('distance');
                    });
                }
                if($item == "Top_Rate")
                {
                    $providers = $providers->whereHas('Rates',function ($q) use ($request){
                        $q->select(DB::raw('SUM(value)/COUNT(user_id) As value'))->orderBy('value');
                    });
                }
                if($item == "Time")
                {
                    $providers = $providers->orderBy('duration');
                }
                if($item == "All_offers")
                {
                    $offer = Offer::where(["product_id" => $id])
                        ->whereDate('start_at','<=', $time)
                        ->whereDate('end_at','>=', $time)
                        ->get();
                    $providers = $providers->whereIn('id', $offer->pluck("provider_id")->toArray());
                }
                if($item == "BITM")
                {
                    $setting = $this->SettingRepo->first();
                    $providers = $providers->whereIn('id', explode(',', str_replace(['"','[',']',' '], '', $setting->product_array)));
                }
                if($item == "Free_Delivery")
                {
                    $providers = $providers->where(['delivery' => "1" , 'delivery_fee' => "0"]);
                }
                if($item == "Free_Items")
                {
                    $meal_offer = Mealoffer::where(["product_id" => $id])
                        ->whereDate('start_at','<=', $time)
                        ->whereDate('end_at','>=', $time)
                        ->get();
                    $providers = $providers->whereIn('id', $meal_offer->pluck("provider_id")->toArray());
                }
                if($item == "Halal")
                {
                    $BranchProduct = BranchProduct::where(["has_alcohol" => 0 , 'has_pig' => 0])->get();
                    $providers = $providers->whereIn('id', $BranchProduct->pluck("branch.provider_id")->unique()->toArray());

                }
            }
        }
        if($request['vtype'])
        {
//            $Types = Type::whereIn("id" , $request['vtype'])->get();
//            $BranchProduct = BranchProduct::whereIn("type" , $Types->pluck("id")->unique())->get();
//            $providers = $providers->whereIn('id', $BranchProduct->pluck("branch.provider_id")->unique()->toArray());

            $Types = Type::whereIn("id" , $request['vtype'])->get();
            $ProviderTypes = ProviderType::whereIn("type_id" , $Types->pluck("id")->unique()->toArray())->get();
            $providers = $providers->whereIn('id', $ProviderTypes->pluck("provider_id")->unique()->toArray());
        }
        $Providers = $providers->where('lock' , 'unlock')->get();
        return view('site.ajax.partners', $this::GData())->with((compact('Providers')));
    }

    public function aProvider(Request $request, $id, $name)
    {
        $Providers = Provider::where(["id" => $id,'lock' => 'unlock'])->first();
        if(isset($Providers))
        {
            $Branches = Branch::where(["provider_id" => $Providers->id])->get();
            $items = BranchProduct::whereIn("branch_id", $Branches->pluck('id')->toArray())->where(["product_type" => "Food"])->get();
            $Additions = BranchProduct::whereIn("branch_id", $Branches->pluck('id')->toArray())->where(["product_type" => "Addition"])->get();

            if (Auth::user())
                $Rate = Rate::where(["provider_id" => $id, "user_id" => Auth::user()->id])->first();
            else
                $Rate = "";
            $avg_rate = Rate::where(["provider_id" => $id])->selectRaw('SUM(value)/COUNT(user_id) As value')->first();
            return view('site.pages.name-details', $this::GData())->with((compact('Providers', 'Branches', 'Rate', 'avg_rate','items','Additions')));
        }
        else
        {
            $Categories = Category::get();
            return view('site.error.lock_provider',$this::GData());
        }
    }

    static function getDeliveryTime($id)
    {
        $orders = Order::where(["id" => $id])->first();
        if (isset($orders))
        {
            if(auth()->user()->type == UsersType::Delivery)
            {
                if(Carbon::parse($orders->ordar_at)->addMinutes($orders->Delivery_time)->gt(Carbon::now()))
                    return Carbon::now()->diffInMinutes(Carbon::parse($orders->ordar_at)->addMinutes($orders->Delivery_time));
            }
            else if(auth()->user()->type == UsersType::Cashier)
            {
                if(isset($orders->delivery))
                {
                    $KM = SiteController::distance($orders->branch->lat, $orders->branch->long, $orders->delivery->lat??$orders->branch->lat, $orders->delivery->long??$orders->branch->long);
                    $Duration = ($KM * 4.5);
                    return $KM;
                }
                else
                {
                    return 30;
                }
            }
            else if(auth()->user()->type == UsersType::Client)
            {
                if(isset($orders->delivery))
                {
                    $KM = SiteController::distance($orders->drop_lat, $orders->drop_long, $orders->delivery->lat??$orders->branch->lat, $orders->delivery->long??$orders->branch->long);
                    if($orders->status == OrderStatus::InProgress)
                        $Duration = ($KM * 4.5 ) + $orders->branch->provider->duration;
                    else
                        $Duration = ($KM * 4.5);
                    return $Duration;
                }
                else
                {
                    return Carbon::now()->diffInMinutes(Carbon::parse($orders->ordar_at)->addMinutes($orders->Delivery_time))+15;
                }
            }
        }
        return 0;
    }

    public function aBranch(Request $request, $id)
    {
        $Branches = Branch::where(["id" => $id])->first();
        $items = BranchProduct::whereIn("branch_id", array($Branches->id, $Branches->parent))->where(["product_type" => "Food"])->get();
        $Additions = BranchProduct::whereIn("branch_id", array($Branches->id, $Branches->parent))->where(["product_type" => "Addition"])->get();
        return view('site.pages.brunch-details', $this::GData())->with((compact('Branches', 'items', 'Additions')));
    }

    public function Sauces(Request $request, $id)
    {
        $Sauce = BranchProduct::where(["product_type" => "Sauce", "id" => $id])->first();
        return view('site.pages.dropdown-content', compact('Sauce'));
    }

    public function verify(Request $request)
    {
        return view('site.pages.verify', $this::GData());
    }
    public function forgetpassword(Request $request)
    {
        return view('site.pages.forgetpassword', $this::GData());
    }
    public function resetpassword(Request $request)
    {
        return view('site.pages.resetpassword', $this::GData());
    }

    public function product_details(Request $request, $id, $name)
    {
        $time = Carbon::now();
        $offer = Offer::where(["product_id" => $id])
            ->whereDate('start_at','<=', $time)
            ->whereDate('end_at','>=', $time)
            ->first();

        $meal_offer = Mealoffer::where(["product_id" => $id])
            ->whereDate('start_at','<=', $time)
            ->whereDate('end_at','>=', $time)
            ->first();

        $items = BranchProduct::where(["id" => $id])->first();
        $Products = BranchProduct::get();
        $Sauces = ProductSauce::where(["product_id" => $id])->get();
        $comments = Comment::where(["product_id" => $id])->get();
        if (count($comments) > 0)
            $comment_likes = CommentLike::whereIn("comment_id", $comments->pluck('id')->toArray())->get();
        else
            $comment_likes = "";
        return view('site.pages.product-details', $this::GData())->with((compact('items', 'comments', 'comment_likes', 'Sauces','offer','meal_offer','Products')));

    }

    static function distance($lat1, $lon1, $lat2, $lon2)
    {
        if (($lat1 == $lat2) && ($lon1 == $lon2)) {
            return 0;
        } else {
            $theta = $lon1 - $lon2;
            $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
            $dist = acos($dist);
            $dist = rad2deg($dist);
            $miles = $dist * 60 * 1.1515;
            return round(($miles * 1.609344), 2);
        }
    }

    static function set_TimeZone()
    {
        $updater = new UpdaterData(public_path('/lib'));
        $updater->updateData();

//        $url = "http://tzid.kambli.net/?lng=".$lon."&lat=".$lat;
//        $json = json_decode(file_get_contents($url), true);
//        if(isset($json['tzname']))
//            return $json;
//        else
//            return null;
    }

    static function get_TimeZone($lon,$lat)
    {
        try{
            $calculator = new Calculator(public_path('/lib/data/'));
            $timeZoneName = $calculator->getTimeZoneName($lat, $lon);
            $json['tzid'] = $timeZoneName;
        }
        catch (\Exception $ex)
        {
            $json['tzid'] = "Europe/Rome";

        }
        return $json;
    }

    static function settingDetail()
    {
        $share_setting = Setting::first();
        return $recs =
            [
                'phone' => $share_setting->phone,
                'assist_phones' => $share_setting->assist_phones,
                'email' => $share_setting->email,
                'facebook' => $share_setting->facebook,
                'twitter' => $share_setting->twitter,
                'linkedin' => $share_setting->linkedin,
                'youtube' => $share_setting->youtube,
            ];
    }


    static function distance_Provider($provider_id)
    {
        $share_setting = Setting::first();
        $Providers = Provider::where(['id' => $provider_id,'lock' => 'unlock'])->first();
        $miles = 0;
        $nearestBranch = Branch::select(DB::raw('*, ( 6371 * acos( cos( radians(' .
            (auth()->user()->lat ?? 0) . ') ) * cos( radians(`lat`) ) * cos(radians(`long`) - radians(' .
            (auth()->user()->long ?? 0) . ') ) + sin( radians(' . (auth()->user()->lat ?? 0) .
            ') ) * sin( radians(`lat`) ) ) ) as distance'))
            ->having('distance', '<=', $Providers->range_delivery??$share_setting->range)->orderBy('distance')->where('provider_id', $provider_id)->first();
        if($nearestBranch)
        {
            $lat2 = $nearestBranch->lat;
            $lon2 = $nearestBranch->long;
            if ((auth()->user()->lat == $lat2) && (auth()->user()->long == $lon2))
            {
                return 0;
            } else {
                $theta = auth()->user()->long - $lon2;
                $dist = sin(deg2rad(auth()->user()->lat)) * sin(deg2rad($lat2)) + cos(deg2rad(auth()->user()->lat)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
                $dist = acos($dist);
                $dist = rad2deg($dist);
                $miles += $dist * 60 * 1.1515;
            }
            $km = round(($miles * 1.609344), 2);
            if ($km <= 2) {
                $ship_price = $km * $share_setting->shipping;
            } else {
                $price_for_first2 = 2 * $share_setting->shipping;
                $price_for_remain = ($km - 2) * $share_setting->shipping2;
                $ship_price = $price_for_first2 + $price_for_remain;
            }
            $ship_price = 0;
            $jsons=[];
            $origin = auth()->user()->lat.",".auth()->user()->long;
            $destination= $lat2.",".$lon2;
            $url = "https://maps.googleapis.com/maps/api/distancematrix/json?units=imperial&origins=" . $origin . "&destinations=" . $destination . "&&key=". env('Google_key');
            $json = json_decode(file_get_contents($url), true);
            if($json["status"] != "REQUEST_DENIED")
            {
                array_push($jsons,$json['rows'][0]['elements'][0]['duration']['value']);
                $minutes = (max($jsons)/60) + $Providers->duration;
                $hours = floor($minutes / 60);
                $min = floor($minutes - ($hours * 60));
            }
            else
            {
                return $recs =
                    [
                        'shipping' => "NaN",
                        'Time' => "NaN",
                    ];
            }
            $theta = auth()->user()->long - $lon2;
            $dist = sin(deg2rad(auth()->user()->lat)) * sin(deg2rad($lat2)) + cos(deg2rad(auth()->user()->lat)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
            $dist = acos($dist);
            $dist = rad2deg($dist);
            $miles = $dist * 60 * 1.1515;
            $km = round(($miles * 1.609344), 2);
            $ship_price = 0;
            if ($km <= 2) {
                $ship_price = $km * $share_setting->shipping;
            } else {
                $price_for_first2 = 2 * $share_setting->shipping;
                $price_for_remain = ($km - 2) * $share_setting->shipping2;
                $ship_price = $price_for_first2 + $price_for_remain;
            }

            return $recs =
                [
                    'shipping' => round($ship_price < ($share_setting->min_shipping ?? 1) ? ($share_setting->min_shipping ?? 1) : $ship_price ,2)."",
                    'Tax' => $share_setting->tax,
                    'Duration' => $json["status"] != "REQUEST_DENIED" ? $minutes : (($km * 4.5 ) + $Providers->duration),
                    'Distance' => $km,
                ];
        }
        else
        {
            return $recs =
                [
                    'shipping' => "NaN",
                    'Time' => "NaN",
                ];
        }
    }

    static function check_state($provider_id)
    {
        $share_setting = Setting::first();
        $Providers = Provider::where(['id' => $provider_id,'lock' => 'unlock'])->first();
        $lat1 = (auth()->user()->lat?? auth('api')->user()->lat ?? 0);
        $lon1 = (auth()->user()->long ?? auth('api')->user()->long ?? 0);

        $nearestBranch = Branch::select(DB::raw('*, ( 6371 * acos( cos( radians(' .
            $lat1 . ') ) * cos( radians(`lat`) ) * cos(radians(`long`) - radians(' .
            $lon1 . ') ) + sin( radians(' . $lat1 .
            ') ) * sin( radians(`lat`) ) ) ) as distance'))
            ->having('distance', '<=', $Providers->range_delivery??$share_setting->range)->orderBy('distance')->where('provider_id', $provider_id)->first();
        if($nearestBranch)
        {
            if($nearestBranch->status==0)
            {
                return "1";
            }
            else
            {
                return "0";
            }
        }
        elseif(auth()->check() || auth('api')->check())
        {
            return "2";
        }
        else
        {
            return "1";
        }
    }

    static function has_offer($Product,$flag)
    {
        $data=array();
        $time = Carbon::now();
        if($flag)
        {
            $offers = Offer::where(["product_id" => $Product])
                ->whereDate('start_at','<=', $time)
                ->whereDate('end_at','>=', $time)
                ->get();

            $max = 0;
            $i_offer = null;
            foreach ($offers as $offer)
            {
                if($offer->value > $max)
                {
                    $max = $offer->value;
                    $i_offer = $offer;
                }
            }

            $items = BranchProduct::where(["id" => $Product])->first();

            if ($i_offer != null)
            {
                $data['offer_price'] = ($offer->value/100)*$items->price;
                $data['offer_value'] = $offer->value.'%';
                $data['start_at'] = $i_offer->end_at;
                $data['end_at'] = $i_offer->start_at;
            }
            else
            {
                $data = null;
            }



        }
        else
        {
            $offers = Offer::where(['provider_id' => $Product])
                ->whereDate('start_at','<=', $time)
                ->whereDate('end_at','>=', $time)
                ->get();
            $max = 0;
            foreach ($offers as $offer)
            {
                if($offer->value > $max)
                    $max = $offer->value;
            }

             if ($max > 0)
             {
                 $data['offer_value'] = $max.'%';
             }
             else
             {
                 $data = null;
             }
        }

        return $data;
    }

    static function userDis($ID)
    {
        if (auth()->check() || auth('api')->check()) {
            $share_setting = Setting::first();
            $lat1 = (auth()->user()->lat?? auth('api')->user()->lat ?? 0);
            $lon1 = (auth()->user()->long ?? auth('api')->user()->long ?? 0);

            $nearest_branch = Branch::select(DB::raw('*, ( 6371 * acos( cos( radians(' .
                $lat1 . ') ) * cos( radians(`lat`) ) * cos(radians(`long`) - radians(' .
                $lon1 . ') ) + sin( radians(' . $lat1 .
                ') ) * sin( radians(`lat`) ) ) ) as distance'))
                ->having('distance', '<=', $share_setting->range)
                ->orderBy('distance')->where('provider_id', $ID)->first();
            $Provider = Provider::where(['id' => $ID])->first();

            if ($nearest_branch != null) {
                $lat2 = $nearest_branch->lat;
                $lon2 = $nearest_branch->long;
                $theta = $lon1 - $lon2;
                $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
                $dist = acos($dist);
                $dist = rad2deg($dist);
                $miles = $dist * 60 * 1.1515;
                $km = ceil($miles * 1.609344);
                $ship_price = 0;
                if($Provider->delivery == 0 || $km > $Provider->range_delivery){
                    if ($km <= 2) {
                        $ship_price = $km * $share_setting->shipping;
                    } else {
                        $price_for_first2 = 2 * $share_setting->shipping;
                        $price_for_remain = ($km - 2) * $share_setting->shipping2;
                        $ship_price = $price_for_first2 + $price_for_remain;
                    }
                }
                else{
                    return
                        [
                            'shipping' => round($km * $Provider->delivery_fee ,2)."",
                            'Tax' => round($share_setting->tax ,2)."",
                            'Duration' => (($km * 4.5 ) + $Provider->duration),
                            'Distance' => $km,
                        ];
                }

                return
                    [
                        'shipping' => round($ship_price < ($share_setting->min_shipping ?? 1) ? ($share_setting->min_shipping ?? 1) : $ship_price ,2)."",
                        'Tax' => round($share_setting->tax ,2)."",
                        'Duration' => (($km * 4.5 ) + $Provider->duration),
                        'Distance' => $km,
                    ];
            }
            else
            {
                return
                    [
                        'shipping' => "NaN",
                        'Tax' => $share_setting->tax,
                        'Duration' => 0,
                        'Distance' => 0,
                    ];
            }
        }
    }

    static function distance2($lat1, $lon1 ,$need=null,$ID=null)
    {
        if($lat1 && $lon1)
        {
            User::where(["id" => auth()->user()->id ?? auth('api')->user()->id])->update([
                'lat' => $lat1,
                'long' => $lon1
            ]);
        }
        $share_setting = Setting::first();
        $lat1 = (auth()->user()->lat?? auth('api')->user()->lat ?? 0);
        $lon1 = (auth()->user()->long ?? auth('api')->user()->long ?? 0);
        if (auth()->check()) {
            if (count(auth()->user()->carts->pluck('product.branch.provider_id')->unique()) == 1 || $need)
            {
                $nearestBranch = Branch::select(DB::raw('*, ( 6371 * acos( cos( radians(' .
                    $lat1 . ') ) * cos( radians(`lat`) ) * cos(radians(`long`) - radians(' .
                    $lon1 . ') ) + sin( radians(' . $lat1 .
                    ') ) * sin( radians(`lat`) ) ) ) as distance'))
                    ->having('distance', '<=', $Providers->range_delivery??$share_setting->range)
                    ->orderBy('distance')->where('provider_id', $ID??auth()->user()->carts[0]->product->branch->provider_id??auth('api')->user()->carts[0]->product->branch->provider_id)->first();
                $Providers = Provider::where(['id' => $ID??auth()->user()->carts[0]->product->branch->provider_id??auth('api')->user()->carts[0]->product->branch->provider_id,'lock' => 'unlock'])->first();

                if($nearestBranch == null)
                {
                    return $recs =
                        [
                            'shipping' => "NaN",
                            'Tax' => $share_setting->tax,
                            'Duration' => 0,
                            'Distance' => 0,
                        ];
                }
                $lat2 = $nearestBranch->lat;
                $lon2 = $nearestBranch->long;
                if (($lat1 == $lat2) && ($lon1 == $lon2)) {
                    return $recs =
                        [
                            'shipping' => "NaN",
                            'Tax' => $share_setting->tax,
                            'Duration' => 0,
                            'Distance' => 0,
                        ];
                }
                else
                {
                    $jsons=[];
                    $origin = $lat1.",".$lon1;
                    $destination= $lat2.",".$lon2;

                    $url = "https://maps.googleapis.com/maps/api/distancematrix/json?units=imperial&origins=" . $origin . "&destinations=" . $destination . "&&key=". env('Google_key');
                    $json = json_decode(file_get_contents($url), true);
                    if($json["status"] != "REQUEST_DENIED")
                    {
                        array_push($jsons,$json['rows'][0]['elements'][0]['duration']['value']);
                        $minutes = (max($jsons)/60) + $Providers->duration;
                        $hours = floor($minutes / 60);
                        $min = floor($minutes - ($hours * 60));
                    }
                    $theta = $lon1 - $lon2;
                    $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
                    $dist = acos($dist);
                    $dist = rad2deg($dist);
                    $miles = $dist * 60 * 1.1515;
                    $km = ceil($miles * 1.609344);
                    $ship_price = 0;
                    if ($km <= 2) {
                        $ship_price = $km * $share_setting->shipping;
                    } else {
                        $price_for_first2 = 2 * $share_setting->shipping;
                        $price_for_remain = ($km - 2) * $share_setting->shipping2;
                        $ship_price = $price_for_first2 + $price_for_remain;
                    }

                    return $recs =
                        [
                            'shipping' => round($ship_price < ($share_setting->min_shipping ?? 1) ? ($share_setting->min_shipping ?? 1) : $ship_price ,2)."",
                            'Tax' => round($share_setting->tax ,2)."",
                            'Duration' => $json["status"] != "REQUEST_DENIED" ? $minutes : (($km * 4.5 ) + $Providers->duration) ,
                            'Distance' => $km,
                        ];
                }
            }
            else
            {
                $miles = 0;
                $jsons=[];
                foreach (auth()->user()->carts->pluck('product.branch.provider_id')->unique() as $key => $item)
                {
                    $nearestBranch = Branch::select(DB::raw('*, ( 6371 * acos( cos( radians(' .
                        $lat1 . ') ) * cos( radians(`lat`) ) * cos(radians(`long`) - radians(' .
                        $lon1 . ') ) + sin( radians(' . $lat1 .
                        ') ) * sin( radians(`lat`) ) ) ) as distance'))
                        ->having('distance', '<=', $Providers->range_delivery??$share_setting->range)->orderBy('distance')->where('provider_id', $item)->first();
                    $Providers = Provider::where(['id' => $item,'lock' => 'unlock'])->first();

                    if($nearestBranch == null)
                    {
                        return $recs =
                            [
                                'shipping' => "NaN",
                                'Tax' => $share_setting->tax,
                                'Duration' => 0,
                                'Distance' => 0,
                            ];
                    }
                    $lat2 = $nearestBranch->lat;
                    $lon2 = $nearestBranch->long;
                    if (($lat1 == $lat2) && ($lon1 == $lon2)) {
                        return 0;
                    } else {
                        $origin = $lat1.",".$lon1;
                        $destination= $lat2.",".$lon2;

                        $url = "https://maps.googleapis.com/maps/api/distancematrix/json?units=imperial&origins=" . $origin . "&destinations=" . $destination . "&&key=". env('Google_key');
                        $json = json_decode(file_get_contents($url), true);
                        if($json["status"] != "REQUEST_DENIED")
                        {
                            array_push($jsons,$json['rows'][0]['elements'][0]['duration']['value']);

                            $minutes = (max($jsons)/60) + $Providers->duration;
                            $hours = floor($minutes / 60);
                            $min = floor($minutes - ($hours * 60));
                        }
                        $theta = $lon1 - $lon2;
                        $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
                        $dist = acos($dist);
                        $dist = rad2deg($dist);
                        $miles += $dist * 60 * 1.1515;
                    }
                }
                $km = round(($miles * 1.609344), 2);
                $ship_price = 0;
                if ($km <= 2) {
                    $ship_price = $km * $share_setting->shipping;
                } else {
                    $price_for_first2 = 2 * $share_setting->shipping;
                    $price_for_remain = ($km - 2) * $share_setting->shipping2;
                    $ship_price = $price_for_first2 + $price_for_remain;
                }

                try {
                    return $recs =
                        [
                            'shipping' => round($ship_price < ($share_setting->min_shipping ?? 1) ? ($share_setting->min_shipping ?? 1) : $ship_price , 2),
                            'Tax' => round($share_setting->tax ,2)."",
                            'Duration' => $json["status"] != "REQUEST_DENIED" ? $minutes : (($km * 4.5 ) + $Providers->duration),
                            'Distance' => $km,
                        ];
                }
                catch (\Exception $e)
                {

                }
            }
        }
        return $recs =
            [
                'shipping' => "NaN",
                'Tax' => $share_setting->tax,
                'Duration' => 0,
                'Distance' => 0,
            ];
    }



    public function becomeDelivery()
    {
        return view('site.pages.deliver', $this::GData());
    }

    public function deliveryRegister(DeliveryRegisterRequest $request)
    {
        $data = $request->validated();
        if ($request->front_id_image) {
            $data['front_id_image'] = UploadImages::upload($request->front_id_image, 'Delivery');
        }
        if ($request->back_id_image) {
            $data['back_id_image'] = UploadImages::upload($request->back_id_image, 'Delivery');
        }
        if ($request->license_image) {
            $data['license_image'] = UploadImages::upload($request->license_image, 'Delivery');
        }
        if ($request->license_expire) {
            $data['license_expire'] = UploadImages::upload($request->license_expire, 'Delivery');
        }

        $data['type'] = UsersType::Delivery;
        $data['active'] = UsersStatus::InActive;
        $user = User::create($data);
        \auth()->login($user);
        return redirect(url('/'));
    }

    public function subscribe(SubscribeRequest $request)
    {
        Subscriber::create($request->validated());
        return back()->with('success', trans('done'));
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

//        foreach ($products as $item)
//        {
//            if ($item->start_outofstock)
//            {
//                $now = Carbon::now()->addDay(1);
//                $start_date = Carbon::parse($item->start_outofstock);
//                $end_date = Carbon::parse($item->end_outofstock);
//
//                if($start_date <= $now && $now <= $end_date) {
//                    BranchProduct::where(["id" => $item->id])->update(['has_outofstock' => 1]);
//                }else{
//                    BranchProduct::where(["id" => $item->id])->update(['has_outofstock' => 0]);
//                }
//            }
//        }
        $Categories = Category::get();
        $Providers = Provider::where(['lock' => 'unlock'])->get();
        $products = BranchProduct::get();
        $items = BranchProduct::where(["product_type" => "Food"])->get();
        $Addition = BranchProduct::where(["product_type" => "Addition"])->get();
        $Rate = Rate::get();
        $setting = Setting::first();
        return compact('Categories', 'Providers', 'Token', 'MyProviders', 'items', 'Addition', 'Rate', 'MyRate' ,'offers','meal_offers','products','setting');
    }

}
