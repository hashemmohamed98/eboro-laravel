<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\ApiContactUsRequest;
use App\Repository\ContactUsRepository;
use App\Services\ApiResponseService;


class ContactUsController extends Controller
{
    protected $contactRepo;
    protected $apiResponse;

    public function __construct(ContactUsRepository $contactRepo,ApiResponseService $apiResponse)
    {
        $this->contactRepo = $contactRepo;
        $this->apiResponse = $apiResponse;
    }

    public function createApi(ApiContactUsRequest $request)
    {
        $contact = $this->contactRepo->create($request->validated());
        return $this->apiResponse->setSuccess(trans('admin.mail_send'))->setCode(200)->send();
    }

}
