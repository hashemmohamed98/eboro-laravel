<?php

namespace App\Http\Controllers\Api;


use App\Helper\UploadImages;
use App\Http\Requests\CategoryRequest;
use App\Http\Resources\CategoryRescource;
use App\Repository\CategoryRepository;
use App\Services\ApiResponseService;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{

    protected $catRepo;
    protected $apiResponse;

    public function __construct(CategoryRepository $catRepo, ApiResponseService $apiResponse)
    {
        $this->catRepo = $catRepo;
        $this->apiResponse = $apiResponse;
    }

    public function create(CategoryRequest $request)
    {
        $data = $request->except('image');
        if ($request->image) {
            $data['image'] = UploadImages::upload($request->image, 'Category');
        }
        $this->catRepo->create($data);
        return $this->apiResponse->setSuccess(trans('admin.created'))->setCode(200)->send();
    }

    public function edit(CategoryRequest $request, $id)
    {
        $category = $this->catRepo->getById($id);
        $data = $request->except('image');
        if ($request->image) {
            $old = $category->image ? public_path('uploads/Category/' . $category->image) : '';
            $data['image'] = UploadImages::upload($request->image, 'Category', $old);
        }
        $this->catRepo->update($id, $data);
        return $this->apiResponse->setSuccess(trans('admin.updated'))->setCode(200)->send();
    }

    public function getAll()
    {
        return $this->apiResponse->setData(CategoryRescource::collection($this->catRepo->getAll()))
            ->setCode(200)->send();
    }

    public function getById($id)
    {
        $cat = $this->catRepo->getById($id);
        if ($cat) {
            return $this->apiResponse->setData(new CategoryRescource($cat))->setCode(200)->send();
        } else {
            return $this->apiResponse->setError(trans('admin.not_found'))->setCode(404)->send();
        }
    }

    public function delete($id)
    {
        $cat = $this->catRepo->find($id);
        if ($cat) {
            $old = $cat->image ? public_path('uploads/Category/' . $cat->image) : null;
            if ($old) {
                unlink($old);
            }
            $this->catRepo->delete($id);
            return $this->apiResponse->setSuccess(trans('admin.deleted'))->setCode(200)->send();
        } else {
            return $this->apiResponse->setError(trans('admin.not_found'))->setCode(404)->send();
        }
    }
}
