<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DemoOrderRescource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
            return [
                'id' => $this->id,
                'user' => new UserRescource($this->user),
                'drop_lat' => $this->drop_lat,
                'drop_long' => $this->drop_long,
                'address' => $this->drop_address,
                'total_price' => "".round($this->total_price ,2),
//                'branch' => $this->branch == null ? OrderMultipleProviderRescource::collection($this->branches) : [array("branch" => new BranchRescource($this->branch) ,'status' => $this->status)] ,
                'status' => $this->status,
                'payment' => $this->payment,
                'tax_price' => "".round($this->tax_price ,2),
                'shipping_price' => "".round($this->shipping_price ,2),
//                'cashier' => new UserRescource($this->cashier),
//                'delivery' => new UserRescource($this->delivery),
                'content' => OrderContentRescource::collection($this->content),
                'ordar_at' => $this->ordar_at,
                'created_at' => $this->created_at,
            ];
    }
}
