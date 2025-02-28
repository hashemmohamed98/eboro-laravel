<?php

namespace App\Http\Controllers\Api;


use App\Http\Requests\CartRequest;
use App\Http\Requests\ChatRequest;
use App\Http\Requests\MealRequest;
use App\Http\Requests\ProductSauceRequest;
use App\Http\Resources\CartRescource;
use App\Http\Resources\ChatRescource;
use App\Http\Resources\MealRescource;
use App\Mealoffer;
use App\Offer;
use App\Repository\BranchProductRepository;
use App\Repository\CartRepository;
use App\Repository\ChatonlineRepository;
use App\Repository\MealofferRepository;
use App\Repository\OrderProductRepository;
use App\Repository\ProductSauceRepository;
use App\Services\ApiResponseService;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class MealController extends Controller
{
    protected $Meal_offerRepo;
    protected $branchProductRepo;
    protected $apiResponse;

    public function __construct(BranchProductRepository $branchProductRepo,MealofferRepository $Meal_offerRepo, ApiResponseService $apiResponse)
    {
        $this->Meal_offerRepo = $Meal_offerRepo;
        $this->branchProductRepo = $branchProductRepo;
        $this->apiResponse = $apiResponse;
    }

    public function get($id)
    {
        $time = Carbon::now();
        $Meal = $this->Meal_offerRepo->where('product_id',$id)->whereDate('start_at','<=', $time)
        ->whereDate('end_at','>=', $time)->get();
        return $this->apiResponse->setData(MealRescource::collection($Meal))->setCode(200)->send();
    }

    public function edit(MealRequest $request , $id)
    {
        $data = $request->except('products','amounts','_token');
        $Product = $this->branchProductRepo->find($id);
        $data['product_id'] = $Product->id;
        $data['branch_id'] = $Product->branch->id;
        $data['provider_id'] = $Product->branch->provider->id;
        $Meal = $this->Meal_offerRepo->find($id);
        if($Meal)
        {
            $Meal->Meal_products()->delete();
            $Meal = $this->Meal_offerRepo->update($id , $data);
        }
        else
        {
            $Meal = $this->Meal_offerRepo->create($data);
        }
        foreach ($request->products as $key => $item)
        {
            $Meal->Meal_products()->create([
                'Meal_id' => $id,
                'product_id' => $request->products[$key],
                'amounts' => $request->amounts[$key],
            ]);
        }

        return $this->apiResponse->setSuccess(trans('admin.done'))->setData($Meal)->setCode(200)->send();
    }

    public function delete($id)
    {
        $Meal = $this->Meal_offerRepo->find($id);
        if ($Meal) {
            $this->Meal_offerRepo->delete($id);
            return $this->apiResponse->setSuccess(trans('admin.deleted'))->setCode(200)->send();
        } else {
            return $this->apiResponse->setError(trans('admin.not_found'))->setCode(404)->send();
        }
    }
}
