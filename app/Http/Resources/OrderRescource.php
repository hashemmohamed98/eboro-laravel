<?php

namespace App\Http\Resources;

use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\SiteController;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderRescource extends JsonResource
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
                'branch' => new LightBranchRescource($this->branch),
                'comment' => $this->comment,
                'gratuity' => $this->gratuity,
                'options' => $this->options,
                'status' => $this->status,
                'total_price' => number_format( (float) $this->total_price, 2, '.', ''),
                'tax_price' => number_format( (float) $this->tax_price, 2, '.', ''),
                'shipping_price' => number_format( (float) $this->shipping_price, 2, '.', ''),
                'refuse_reason' => $this->refuse_reason,
                'payment' => "".$this->payment,
                'content' => OrderContentRescource::collection($this->content),
                'Rate' => OrderRateRescource::collection($this->rate),
                'Delivery_time' => floor(SiteController::getDeliveryTime($this->id)),
                'Delivery_Price' => $this->Delivery_distance,
                'ordar_at' => $this->ordar_at,
                'created_at' => $this->created_at,
                'updated_at' => $this->updated_at,
            ];
    }
}
