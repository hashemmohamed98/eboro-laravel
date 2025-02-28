<?php

namespace App\Http\Resources;

use App\Helper\UsersType;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryRescource extends JsonResource
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
            'name' => $this->{'name_'.app()->getLocale()},
            'image' => $this->image?url('public/uploads/Category/'.$this->image):'',
            'created_at' => $this->created_at,
        ];
    }
}
