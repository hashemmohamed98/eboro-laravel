<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderMultipleProviderRescource extends JsonResource
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
                'branch' => new LightBranchRescource($this->branch),
                'cashier' => new UserRescource($this->cashier),
                'delivery' => new UserRescource($this->delivery),
                'total_price' => number_format( (float) $this->total_price, 2, '.', ''),
                'tax_price' => number_format( (float) $this->tax_price, 2, '.', ''),
                'shipping_price' => number_format( (float) $this->shipping_price, 2, '.', ''),
                'refuse_reason' => $this->refuse_reason,
                'status' => $this->status,
                'created_at' => $this->created_at,
                'updated_at' => $this->updated_at,
            ];
    }
}
