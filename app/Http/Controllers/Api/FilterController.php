<?php

namespace App\Http\Controllers\Api;


use App\Helper\UploadImages;
use App\Http\Requests\AddToFavRequest;
use App\Http\Requests\AddToRateRequest;
use App\Http\Requests\ProviderByCatRequest;
use App\Http\Requests\ProviderRequest;
use App\Http\Resources\ProviderRescource;
use App\Http\Resources\TypesRescource;
use App\Mealoffer;
use App\Models\BranchProduct;
use App\Models\Favorite;
use App\Models\Rate;
use App\Offer;
use App\ProviderType;
use App\Repository\ProviderRepository;
use App\Repository\RateRepository;
use App\Repository\SettingRepository;
use App\Services\ApiResponseService;
use App\Http\Controllers\Controller;
use App\Setting;
use App\Type;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FilterController extends Controller
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
    public function Filter(Request $request, $id)
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
            $Types = Type::whereIn("id" , $request['vtype'])->get();
            $ProviderTypes = ProviderType::whereIn("type_id" , $Types->pluck("id")->unique()->toArray())->get();
            $providers = $providers->whereIn('id', $ProviderTypes->pluck("provider_id")->unique()->toArray());
        }
        if ($providers)
        {
            return $this->apiResponse->setData(ProviderRescource::collection($providers->get()))->setCode(200)->send();
        }
        else
        {
            return $this->apiResponse->setError(trans('admin.not_found'))->setCode(404)->send();
        }
    }
    public function Filter_type($id)
    {
        $types = Type::where(["category_id" => $id??1])->orderBy('position', 'asc')->get();
        if ($types)
        {
            return $this->apiResponse->setData(TypesRescource::collection($types))->setCode(200)->send();
        }
        else
        {
            return $this->apiResponse->setError(trans('admin.not_found'))->setCode(404)->send();
        }
    }
}
