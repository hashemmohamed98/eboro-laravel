<?php

namespace App\Http\Resources;

use App\Models\Rate;
use Illuminate\Http\Resources\Json\JsonResource;

class MealRescource extends JsonResource
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
            'value' => $this->value,
            'products' => MealORescource::collection($this->Meal_products),
            'branch' => new BranchRescource($this->branch),
            'provider' => new ProviderRescource($this->provider),
            'start_at' => $this->start_at,
            'end_at' => $this->end_at,
            'created_at' => $this->created_at->diffForHumans(),
        ];
    }
}
