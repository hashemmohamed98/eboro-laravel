<?php

namespace App\Http\Resources;

use App\Http\Controllers\SiteController;
use App\Models\Rate;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\App;

class TypesRescource extends JsonResource
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
            'category_id' => $this->category_id,
            'image' => $this->image?url('public/uploads/Types/'.$this->image):'',
            'type' => $this->{'type_'.App::getLocale()},
            'created_at' => $this->created_at,
        ];
    }
}
