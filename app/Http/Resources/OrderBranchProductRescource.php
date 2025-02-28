<?php

namespace App\Http\Resources;

use App\Http\Controllers\SiteController;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderBranchProductRescource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        if ($this["product"]->product_type == 'Food') {
            return [
                'id' => $this["product"]->id,
                'name' => $this["product"]->name,
                'description' => $this["product"]->description,
                'price' => number_format( (float) $this["product"]->price, 2, '.', ''),
                'offer' => (SiteController::has_offer($this["product"]->id,true)),
                'type' => new TypesRescource($this["product"]->typed),
                'image' => $this["product"]->image ? asset('public/uploads/Product/' . $this["product"]->image.'?v='.time()) : '',
                'has_alcohol' => $this["product"]->has_alcohol,
                'has_outofstock' => $this["product"]->has_outofstock,
                'start_outofstock' => $this["product"]->start_outofstock,
                'end_outofstock' => $this["product"]->end_outofstock,
                'has_pig' => $this["product"]->has_pig,
                'additions' => $this["product"]->additions,
                'calories' => $this["product"]->calories,
                'size' => $this["product"]->size,
                'product_type' => $this["product"]->product_type,
                'sauces' => SaucesRescource::collection($this["sauces"]),
            //    'branch' => new BranchRescource($this->branch),
                'branch' => new LightBranchRescource($this["product"]->branch),
                'created_at' => $this["product"]->created_at,
            ];
        } else {
            return [
                'id' => $this["product"]->id,
                'name' => $this["product"]->name,
                'description' => $this["product"]->description,
                'type' => new TypesRescource($this["product"]->typed),
                'has_outofstock' => $this["product"]->has_outofstock,
                'start_outofstock' => $this["product"]->start_outofstock,
                'end_outofstock' => $this["product"]->end_outofstock,
                'has_alcohol' => $this["product"]->has_alcohol,
                'has_pig' => $this["product"]->has_pig,
                'price' => number_format( (float) $this["product"]->price, 2, '.', ''),
                'product_type' => $this["product"]->product_type,
                'offer' => (SiteController::has_offer($this["product"]->id,true)),
                'image' => $this["product"]->image ? url('public/uploads/Product/' . $this["product"]->image) : '',
           //     'branch' => new BranchRescource($this["product]->branch),
                'branch' => new LightBranchRescource($this["product"]->branch),
                'created_at' => $this["product"]->created_at,
            ];
        }
    }
}
