<?php

namespace App\Http\Controllers\Api;


use App\Http\Requests\FilterBranchProductRequest;
use App\Http\Requests\ProductSauceRequest;
use App\Http\Resources\BranchProductRescource;
use App\Repository\BranchProductRepository;
use App\Repository\ProductSauceRepository;
use App\Services\ApiResponseService;
use App\Http\Controllers\Controller;

class ProductSauceController extends Controller
{
    protected $ProductSauceRepo;
    protected $BranchProductRepo;
    protected $apiResponse;

    public function __construct(BranchProductRepository $BranchProductRepo,ProductSauceRepository $ProductSauceRepo, ApiResponseService $apiResponse)
    {
        $this->ProductSauceRepo = $ProductSauceRepo;
        $this->BranchProductRepo = $BranchProductRepo;
        $this->apiResponse = $apiResponse;
    }

    public function create(ProductSauceRequest $request)
    {
        if($this->BranchProductRepo->getById($request->sauce_id)->product_type=='Sauce'){
            $this->ProductSauceRepo->create($request->validated());
            return $this->apiResponse->setSuccess(trans('admin.created'))->setCode(200)->send();
        }else{
            return $this->apiResponse->setError(trans('admin.sauce_error'))->setCode(400)->send();
        }
    }

    public function delete($id)
    {
        $branch = $this->ProductSauceRepo->find($id);
        if ($branch) {
            $this->ProductSauceRepo->delete($id);
            return $this->apiResponse->setSuccess(trans('admin.deleted'))->setCode(200)->send();
        } else {
            return $this->apiResponse->setError(trans('admin.not_found'))->setCode(404)->send();
        }
    }
}
