<?php

namespace App\Http\Resources;

use App\Models\Rate;
use Illuminate\Http\Resources\Json\JsonResource;

class MealORescource extends JsonResource
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
            'Product' => new BranchProductRescource($this->product),
            'Ammount' => $this->amounts,
            'created_at' => $this->created_at->diffForHumans(),
        ];
    }
}
