<?php

namespace App\Http\Controllers\Api;


use App\Helper\UploadImages;
use App\Http\Requests\AddToFavRequest;
use App\Http\Requests\AddToRateRequest;
use App\Http\Requests\LockProviderRequest;
use App\Http\Requests\ProviderByCatRequest;
use App\Http\Requests\ProviderRequest;
use App\Http\Resources\ProviderRescource;
use App\Models\Favorite;
use App\Models\Rate;
use App\Repository\ProviderRepository;
use App\Repository\ProviderTypeInnerRepository;
use App\Repository\ProviderTypeRepository;
use App\Repository\RateRepository;
use App\Repository\TypeRepository;
use App\Services\ApiResponseService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProviderController extends Controller
{
    protected $providerRepo;
    protected $RateRepo;
    protected $typeRepo;
    protected $typeInnerRepo;
    protected $apiResponse;

    public function __construct(ProviderTypeInnerRepository $typeInnerRepo,ProviderTypeRepository $typeRepo,ProviderRepository $providerRepo, ApiResponseService $apiResponse,RateRepository $RateRepo)
    {
        $this->providerRepo = $providerRepo;
        $this->RateRepo = $RateRepo;
        $this->typeRepo = $typeRepo;
        $this->typeInnerRepo = $typeInnerRepo;
        $this->apiResponse = $apiResponse;
    }

    public function create(ProviderRequest $request)
    {
        $data = $request->except('logo','_token','types','typeInners');
        $data['user_id'] = auth()->id();
        if ($request->logo) {
            $data['logo'] = UploadImages::upload($request->logo, 'Provider');
        }
        $provider = $this->providerRepo->create($data);

        if($request['types'])
        {
            foreach ($request['types'] as $type)
            {
                $this->typeRepo->create([
                    'type_id' => $type,
                    'provider_id' => $provider->id,
                ]);
            }
        }
        if($request['typeInners'])
        {
            foreach ($request['typeInners'] as $type)
            {
                $this->typeInnerRepo->create([
                    'type_id' => $type,
                    'provider_id' => $provider->id,
                ]);
            }
        }
        return $this->apiResponse->setSuccess(trans('admin.created'))->setCode(200)->send();
    }

    public function edit(ProviderRequest $request, $id)
    {
        $provider = $this->providerRepo->getById($id);
        $data = $request->except('logo','_token','types','typeInners');
        if ($request->logo)
        {
            $old = $provider->logo ? public_path('uploads/Provider/' . $provider->logo) : '';
            $data['logo'] = UploadImages::upload($request->logo, 'Provider', $old);
        }
        $this->providerRepo->update($id, $data);

        if($request['types'])
        {
            $this->typeRepo->where('provider_id',$provider->id)->delete();
            foreach ($request['types'] as $type)
            {
                $this->typeRepo->create([
                    'type_id' => $type,
                    'provider_id' => $provider->id,
                ]);
            }
        }
        if($request['typeInners'])
        {
            $this->typeInnerRepo->where('provider_id',$provider->id)->delete();
            foreach ($request['typeInners'] as $type)
            {
                $this->typeInnerRepo->create([
                    'type_id' => $type,
                    'provider_id' => $provider->id,
                ]);
            }
        }

        return $this->apiResponse->setSuccess(trans('admin.updated'))->setCode(200)->send();
    }

    public function lock(LockProviderRequest $request)
    {
        $data = $request->validated();
        $this->providerRepo->update($data['id'], $data);
        return $this->apiResponse->setSuccess(trans('admin.updated'))->setCode(200)->send();
    }

    public function edit_range(Request $request, $id)
    {
        $data = $request->except('logo','typeInners');

        if($request['typeInners'])
        {
            $this->typeInnerRepo->where('provider_id',$id)->delete();
            foreach ($request['typeInners'] as $type)
            {
                $this->typeInnerRepo->create([
                    'type_id' => $type,
                    'provider_id' => $id,
                ]);
            }
        }
        $this->providerRepo->update($id, $data);
        return $this->apiResponse->setSuccess(trans('admin.done'))->setCode(200)->send();
    }

    public function getAll()
    {
        return $this->apiResponse->setData(ProviderRescource::collection($this->providerRepo->where('lock','unlock')->with('user','category')->get()))
            ->setCode(200)->send();
    }

    public function getById($id)
    {
        $provider = $this->providerRepo->with('user','category')->find($id);
        if ($provider) {
            return $this->apiResponse->setData(new ProviderRescource($provider))->setCode(200)->send();
        } else {
            return $this->apiResponse->setError(trans('admin.not_found'))->setCode(404)->send();
        }
    }

    public function userProviders()
    {
        $providers=$this->providerRepo->where(['user_id'=>auth()->id(),'lock' => 'unlock'])->with('user','category')->get();
        return $this->apiResponse->setData(ProviderRescource::collection($providers))->setCode(200)->send();
    }

    public function delete($id)
    {
        $provider = $this->providerRepo->find($id);
        if ($provider) {
            $old = $provider->logo ? public_path('uploads/Provider/' . $provider->logo) : null;
            if ($old) {
                unlink($old);
            }
            $this->providerRepo->delete($id);
            return $this->apiResponse->setSuccess(trans('admin.deleted'))->setCode(200)->send();
        } else {
            return $this->apiResponse->setError(trans('admin.not_found'))->setCode(404)->send();
        }
    }

    public function getByCat(ProviderByCatRequest $request)
    {
        $providers = $this->providerRepo
            ->select(
                'providers.*',
                DB::raw('SUM(rates.value)/COUNT(rates.user_id) AS value')
            )
            ->leftJoin('rates', 'rates.provider_id', '=', 'providers.id')
            ->where(['category_id' => $request->category_id, 'lock' => 'unlock'])
            ->groupBy('providers.id') // Ensure proper grouping
            ->orderByDesc('value')
            ->orderBy('providers.position', 'asc')
            ->get();

        return $this->apiResponse->setData(ProviderRescource::collection($providers))->setCode(200)->send();
    }

    public function AddToFav(AddToFavRequest $request)
    {
        $Favorite = Favorite::where(["provider_id" => $request->provider_id, "user_id" => auth()->id()])->first();
        if ($Favorite) {
            $Favorite->delete();
        } else {
            Favorite::create($request->validated());
        }
        return $this->apiResponse->setSuccess(trans('admin.created'))->setCode(200)->send();
    }

    public function AddToRate(AddToRateRequest $request)
    {
        $Rate = Rate::where(["provider_id" => $request->provider_id, "user_id" => auth()->id()])->first();

        if ($Rate) {
            $this->RateRepo->update($Rate->id , $request->validated());
        } else {
            Rate::create($request->validated());
        }
        return $this->apiResponse->setSuccess(trans('admin.created'))->setCode(200)->send();
    }

}
