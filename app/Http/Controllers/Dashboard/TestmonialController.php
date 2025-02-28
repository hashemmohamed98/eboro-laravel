<?php

namespace App\Http\Controllers\Dashboard;

use App\Helper\UploadImages;
use App\Http\Controllers\Controller;
use App\Http\Requests\TestimonialRequest;
use App\Repository\TestmonialRepository;

class TestmonialController extends Controller
{
    protected $testRepo;

    public function __construct(TestmonialRepository $testRepo)
    {
        $this->testRepo = $testRepo;
    }

    public function index()
    {
        $tests = $this->testRepo->getAll();
        return view('admin.testmonial', compact('tests'));
    }

    public function create(TestimonialRequest $request)
    {
        $data=$request->except('_token','image');
        if($request->image){
            $data['image']=UploadImages::upload($request->image,'Testmonial');
        }
        $this->testRepo->create($data);
        return back()->with('success', 'Added');
    }

    public function edit($id, TestimonialRequest $request)
    {
        $test=$this->testRepo->getById($id);
        $data=$request->except('_token','image');
        if($request->image){
            $data['image']=UploadImages::upload($request->image,'Testmonial',public_path('uploads/Testmonial/'.$test->image));
        }
        $this->testRepo->update($id, $data);
        return back()->with('success', 'Updated');
    }

    public function delete($id)
    {
        if ($test=$this->testRepo->getById($id)) {
            unlink(public_path('uploads/Testmonial/'.$test->image));
            $this->testRepo->delete($id);
            return back()->with('success', 'Deleted');
        } else {
            return back()->with('error', 'Not Found');
        }
    }
}
