<?php

namespace App\Http\Resources;

use App\Http\Controllers\SiteController;
use Illuminate\Http\Resources\Json\JsonResource;

class BranchProductRescource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        if ($this->product_type == 'Food') {
            return [
                'id' => $this->id,
                'name' => $this->name,
                'description' => $this->description,
                'price' => number_format( (float) $this->price, 2, '.', ''),
                'offer' => (SiteController::has_offer($this->id,true)),
                'type' => new TypesRescource($this->typed),
                'image' => $this->image ? asset('public/uploads/Product/' . $this->image.'?v='.time()) : '',
                'has_alcohol' => $this->has_alcohol,
                'has_outofstock' => $this->has_outofstock,
                'start_outofstock' => $this->start_outofstock,
                'end_outofstock' => $this->end_outofstock,
                'has_pig' => $this->has_pig,
                'additions' => $this->additions,
                'calories' => $this->calories,
                'size' => $this->size,
                'product_type' => $this->product_type,
                'sauces' => SaucesRescource::collection($this->sauces),
            //    'branch' => new BranchRescource($this->branch),
                'branch' => new LightBranchRescource($this->branch),
                'created_at' => $this->created_at,
            ];
        } else {
            return [
                'id' => $this->id,
                'name' => $this->name,
                'description' => $this->description,
                'type' => new TypesRescource($this->typed),
                'has_outofstock' => $this->has_outofstock,
                'start_outofstock' => $this->start_outofstock,
                'end_outofstock' => $this->end_outofstock,
                'has_alcohol' => $this->has_alcohol,
                'has_pig' => $this->has_pig,
                'price' => number_format( (float) $this->price, 2, '.', ''),
                'product_type' => $this->product_type,
                'offer' => (SiteController::has_offer($this->id,true)),
                'image' => $this->image ? url('public/uploads/Product/' . $this->image) : '',
           //     'branch' => new BranchRescource($this->branch),
                'branch' => new LightBranchRescource($this->branch),
                'created_at' => $this->created_at,
            ];
        }
    }
}
