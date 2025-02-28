<?php

namespace App\Http\Controllers\Api;


use App\Helper\UploadImages;
use App\Http\Requests\CartRequest;
use App\Http\Requests\ProductSauceRequest;
use App\Http\Requests\PromoCodeRequest;
use App\Http\Resources\CartRescource;
use App\Mealoffer;
use App\Offer;
use App\Repository\BranchProductRepository;
use App\Repository\CartRepository;
use App\Repository\ProductSauceRepository;
use App\Repository\PromocodeRepository;
use App\Repository\PromouserRepository;
use App\Repository\UserRepository;
use App\Services\ApiResponseService;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class PromoController extends Controller
{
    protected $UserRepo;
    protected $PromoUserRepo;
    protected $codesRepo;
    protected $apiResponse;

    public function __construct(PromocodeRepository $codesRepo, PromouserRepository $PromoUserRepo, UserRepository $UserRepo, ApiResponseService $apiResponse)
    {
        $this->UserRepo = $UserRepo;
        $this->PromoUserRepo = $PromoUserRepo;
        $this->codesRepo = $codesRepo;
        $this->apiResponse = $apiResponse;
    }

    public function add(PromoCodeRequest $request)
    {
        $data = $request->except('_token');
        $this->codesRepo->create($data);
        return $this->apiResponse->setSuccess(trans('admin.created'))->setCode(200)->send();
    }

    public function edit(PromoCodeRequest $request, $id)
    {
        $data = $request->except('_token');
        $this->codesRepo->update($id,$data);
        return $this->apiResponse->setSuccess(trans('admin.done'))->setCode(200)->send();
    }

    public function delete($id)
    {
        $codes = $this->codesRepo->find($id);
        if ($codes) {
            $this->codesRepo->delete($id);
            return $this->apiResponse->setSuccess(trans('admin.deleted'))->setCode(200)->send();
        } else {
            return $this->apiResponse->setError(trans('admin.not_found'))->setCode(404)->send();
        }
    }
}
