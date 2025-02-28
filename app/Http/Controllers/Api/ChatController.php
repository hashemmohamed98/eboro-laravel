<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\CartRequest;
use App\Http\Requests\ChatRequest;
use App\Http\Resources\BranchProductRescource;
use App\Http\Resources\CartRescource;
use App\Http\Resources\ChatRescource;
use App\Repository\ChatonlineRepository;
use App\Repository\OrderProductRepository;
use App\Services\ApiResponseService;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class ChatController extends Controller
{
    protected $ChatRepo;
    protected $OrderRepo;
    protected $apiResponse;

    public function __construct(ChatonlineRepository $ChatRepo, OrderProductRepository $OrderRepo, ApiResponseService $apiResponse)
    {
        $this->ChatRepo = $ChatRepo;
        $this->OrderRepo = $OrderRepo;
        $this->apiResponse = $apiResponse;
    }

    public function get($id)
    {
        $chat = $this->ChatRepo->where(['order_id'=>$id , 'type'=>'user'])->get();
        return $this->apiResponse->setData(ChatRescource::collection($chat))->setCode(200)->send();
    }

    public function get_dl($id)
    {
        $chat = $this->ChatRepo->where(['order_id'=>$id , 'type'=>'delivery'])->get();
        return $this->apiResponse->setData(ChatRescource::collection($chat))->setCode(200)->send();
    }

    public function add(ChatRequest $request)
    {
        $Chat = $this->ChatRepo->create($request->validated());
        return $this->apiResponse->setSuccess(trans('admin.done'))->setData($Chat)->setCode(200)->send();
    }

    public function add_delivery(ChatRequest $request)
    {
        $Chat = $request->validated();
        $Chat['type'] = 'delivery';
        $Chat = $this->ChatRepo->create($Chat);
        return $this->apiResponse->setSuccess(trans('admin.done'))->setData($Chat)->setCode(200)->send();
    }

    public function delete($id)
    {
        $Chat = $this->ChatRepo->find($id);
        if ($Chat) {
            $this->ChatRepo->delete($id);
            return $this->apiResponse->setSuccess(trans('admin.deleted'))->setCode(200)->send();
        } else {
            return $this->apiResponse->setError(trans('admin.not_found'))->setCode(404)->send();
        }
    }
}
