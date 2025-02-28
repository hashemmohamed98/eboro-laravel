<?php

namespace App\Http\Controllers\Api;


use App\Helper\UploadImages;
use App\Http\Requests\BranchRequest;
use App\Http\Requests\CreateBranchStaffRequest;
use App\Http\Requests\EditBranchStaaffRequest;
use App\Http\Requests\FilterStaffRequest;
use App\Http\Requests\ProviderBranchRequest;
use App\Http\Resources\BranchStaffRescource;
use App\Repository\BranchStaffRepository;
use App\Repository\UserRepository;
use App\Services\ApiResponseService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class BranchStaffController extends Controller
{
    protected $branchStaffRepo;
    protected $userRepo;
    protected $apiResponse;

    public function __construct(UserRepository $userRepo,BranchStaffRepository $branchStaffRepo, ApiResponseService $apiResponse)
    {
        $this->branchStaffRepo = $branchStaffRepo;
        $this->userRepo = $userRepo;
        $this->apiResponse = $apiResponse;
    }

    public function create(CreateBranchStaffRequest $request)
    {
        DB::beginTransaction();
        $user=$this->userRepo->register($request->validated());
        $data['user_id']=$user->id;
        $data['branch_id']=$request->branch_id;
        $data['type']=$request->type;
        $this->branchStaffRepo->create($data);
        DB::commit();
        return $this->apiResponse->setSuccess(trans('admin.created'))->setCode(200)->send();
    }

    public function edit(EditBranchStaaffRequest $request, $id)
    {
        $staff=$this->branchStaffRepo->with('user')->find($id);
        $data = $request->except('password', 'image','type');
        if ($request->image) {
            $old = ($staff->user->image) ?public_path('uploads/User/' . $staff->user->image):'';
            $data['image'] = UploadImages::upload($request->image, 'User', $old);
        }
        if ($request->password) {
            $data['password'] = bcrypt($request->password);
        }
        DB::beginTransaction();
        $user = $this->userRepo->update($staff->user->id, $data);
        $this->branchStaffRepo->update($id, $request->only('type','branch_id'));
        DB::commit();
        return $this->apiResponse->setSuccess(trans('admin.updated'))->setCode(200)->send();
    }

    public function filterStaff(FilterStaffRequest $request)
    {
        $staff=$this->branchStaffRepo->with('user','branch');
        if(isset($request->type)){
            $staff=$staff->where('type',$request->type);
        }
        if(isset($request->branch_id)){
            $staff=$staff->where('branch_id',$request->branch_id);
        }
        $staff=$staff->where('user_id',auth()->id())->get();
        return $this->apiResponse->setData(BranchStaffRescource::collection($staff))->setCode(200)->send();
    }

    public function getById($id)
    {
        $branch = $this->branchStaffRepo->with('user','branch')->find($id);
        if ($branch) {
            return $this->apiResponse->setData(new BranchStaffRescource($branch))->setCode(200)->send();
        } else {
            return $this->apiResponse->setError(trans('admin.not_found'))->setCode(404)->send();
        }
    }

    public function delete($id)
    {
        $branch = $this->branchStaffRepo->with('user')->find($id);
        if ($branch) {
            DB::beginTransaction();
            $this->userRepo->delete($branch->user_id);
//            $this->branchStaffRepo->delete($id);
            DB::commit();
            return $this->apiResponse->setSuccess(trans('admin.deleted'))->setCode(200)->send();
        } else {
            return $this->apiResponse->setError(trans('admin.not_found'))->setCode(404)->send();
        }
    }
}
