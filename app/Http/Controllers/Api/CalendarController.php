<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\SiteController;
use App\Http\Requests\BranchRequest;
use App\Http\Requests\CalendarRequest;
use App\Http\Requests\ProviderBranchRequest;
use App\Http\Resources\BranchRescource;
use App\Http\Resources\CalendarRescource;
use App\Models\Provider;
use App\Repository\BranchRepository;
use App\Repository\CalendarRepository;
use App\Services\ApiResponseService;
use App\Http\Controllers\Controller;

class CalendarController extends Controller
{
    protected $calendarRepo;
    protected $apiResponse;

    public function __construct(CalendarRepository $calendarRepo, ApiResponseService $apiResponse)
    {
        $this->calendarRepo = $calendarRepo;
        $this->apiResponse = $apiResponse;
    }

    public function create(CalendarRequest $request)
    {
        $this->calendarRepo->create($request->validated());
        return $this->apiResponse->setSuccess(trans('admin.created'))->setCode(200)->send();
    }

    public function getAll()
    {
        $calendars=$this->calendarRepo->where('user_id', auth()->id())->get();
        return $this->apiResponse->setData(CalendarRescource::collection($calendars))->setCode(200)->send();
    }

    public function delete($id)
    {
        $branch = $this->calendarRepo->find($id);
        if ($branch) {
            $this->calendarRepo->delete($id);
            return $this->apiResponse->setSuccess(trans('admin.deleted'))->setCode(200)->send();
        } else {
            return $this->apiResponse->setError(trans('admin.not_found'))->setCode(404)->send();
        }
    }
}
