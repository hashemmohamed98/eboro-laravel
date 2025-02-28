<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\SiteController;
use App\Http\Requests\BranchRequest;
use App\Http\Requests\ProviderBranchRequest;
use App\Http\Resources\BranchRescource;
use App\Models\Provider;
use App\Repository\BranchRepository;
use App\Services\ApiResponseService;
use App\Http\Controllers\Controller;

class BranchController extends Controller
{
    protected $branchRepo;
    protected $apiResponse;

    public function __construct(BranchRepository $branchRepo, ApiResponseService $apiResponse)
    {
        $this->branchRepo = $branchRepo;
        $this->apiResponse = $apiResponse;
    }

    public function create(BranchRequest $request)
    {
        foreach ($request["open_time"] as $i => $item)
        {
            $request["OT"] .= $item . (($i+1) == count($request["open_time"]) ? "":",");
        }
        foreach ($request["close_time"] as $i => $item)
        {
            $request["CT"] .= $item . (($i+1) == count($request["open_time"]) ? "":",");
        }
        foreach ($request["open_days"] as $i => $item)
        {
            $request["OD"] .= $item . (($i+1) == count($request["open_time"]) ? "":",");
        }
        $request["open_time"] = $request["OT"];
        $request["close_time"] = $request["CT"];
        $request["open_days"] = $request["OD"];
        $this->branchRepo->create($request->except(["OT","CT","OD"]));
        return $this->apiResponse->setSuccess(trans('admin.created'))->setCode(200)->send();
    }

    public function edit(BranchRequest $request, $id)
    {
        foreach ($request["open_time"] as $i => $item)
        {
            $request["OT"] .= $item . (($i+1) == count($request["open_time"]) ? "":",");
        }
        foreach ($request["close_time"] as $i => $item)
        {
            $request["CT"] .= $item . (($i+1) == count($request["open_time"]) ? "":",");
        }
        foreach ($request["open_days"] as $i => $item)
        {
            $request["OD"] .= $item . (($i+1) == count($request["open_time"]) ? "":",");
        }
        $request["open_time"] = $request["OT"];
        $request["close_time"] = $request["CT"];
        $request["open_days"] = $request["OD"];
        $this->branchRepo->update($id, $request->except(["OT","CT","OD"]));
        return $this->apiResponse->setSuccess(trans('admin.updated'))->setCode(200)->send();
    }

    public function getAll()
    {
        return $this->apiResponse->setData(BranchRescource::collection($this->branchRepo->with('provider','provider.user')->get())) ->setCode(200)->send();
    }

    public function getById($id)
    {
        $branch = $this->branchRepo->with('provider','provider.user')->find($id);
        if ($branch) {
            return $this->apiResponse->setData(new BranchRescource($branch))->setCode(200)->send();
        } else {
            return $this->apiResponse->setError(trans('admin.not_found'))->setCode(404)->send();
        }
    }

    public function providerBranchs(ProviderBranchRequest $request)
    {
        $branches=$this->branchRepo->where('provider_id',$request->provider_id)
            ->with('provider','provider.user')->get();
        return $this->apiResponse->setData(BranchRescource::collection($branches))->setCode(200)->send();
    }

    public function delete($id)
    {
        $branch = $this->branchRepo->find($id);
        if ($branch) {
            $this->branchRepo->delete($id);
            return $this->apiResponse->setSuccess(trans('admin.deleted'))->setCode(200)->send();
        } else {
            return $this->apiResponse->setError(trans('admin.not_found'))->setCode(404)->send();
        }
    }
}
