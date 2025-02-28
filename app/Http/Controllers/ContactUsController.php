<?php

namespace App\Http\Controllers;

use App\Http\Requests\ApiContactUsRequest;
use App\Http\Requests\ContactReplyRequest;
use App\Http\Resources\ContactRescource;
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

    public function userContact()
    {
        $contact = $this->contactRepo->where('user_id',auth()->id())->get();
        return $this->apiResponse->setData(ContactRescource::collection($contact))->setCode(200)->send();
    }

    public function contactDetails($id)
    {
        $contact = $this->contactRepo->find($id);
        if($contact){
        return $this->apiResponse->setData(new ContactRescource($contact))->setCode(200)->send();
        } else{
            return $this->apiResponse->setError('Not Found')->setCode(404)->send();
        }
    }

    public function index()
    {
        $contact = $this->contactRepo->OrderBy('id', 'desc')->get();
        return view('admin.contact', compact('contact'));
    }

    public function delete($id)
    {
        $this->contactRepo->delete($id);
        return back()->with('success', trans('admin.deleted'));
    }

    public function reply($id, ContactReplyRequest $request)
    {
        $contact = $this->contactRepo->update($id, $request->validated());
        return back()->with('success', trans('admin.updated'));
    }

    public function changeState($id)
    {
        $contact = $this->contactRepo->getById($id);
        if($contact->state=='open'){
            $data['state']='closed';
        }else{
            $data['state']='open';
        }
        $this->contactRepo->update($id,$data);
        return back()->with('success', trans('admin.updated'));
    }
}
