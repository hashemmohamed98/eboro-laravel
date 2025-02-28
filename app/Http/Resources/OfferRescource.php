<?php

namespace App\Http\Resources;

use App\Models\Rate;
use Illuminate\Http\Resources\Json\JsonResource;

class OfferRescource extends JsonResource
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
            'provider' => new ProviderRescource($this->provider_id),
            'product' => new BranchProductRescource($this->product_id),
            'branch' => new BranchRescource($this->branch_id),
            'start_at' => $this->start_at,
            'end_at' => $this->end_at,
            'value' => $this->value,
            'max_price' => $this->max_price,
            'code' => $this->code,
            'created_at' => $this->created_at,
        ];
    }
}
