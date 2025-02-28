<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SaucesRescource extends JsonResource
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
            'sauce_id' => $this->sauce->id,
            'name' => $this->sauce->name,
            'description' => $this->sauce->description,
            'price' => number_format( (float) $this->sauce->price, 2, '.', ''),
            'product_type' => $this->sauce->product_type,
            'image' => $this->sauce->image ? url('public/uploads/Product/' . $this->sauce->image) : '',
            'created_at' => $this->created_at,
        ];
    }
}
