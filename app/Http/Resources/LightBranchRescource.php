<?php

namespace App\Http\Resources;

use App\Http\Controllers\SiteController;
use Illuminate\Http\Resources\Json\JsonResource;

class LightBranchRescource extends JsonResource
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
            'name' => $this->name,
            'status' => $this->status==0?"open":"close",
            'lat' => $this->lat,
            'long' => $this->long,
            'hotline' => $this->hot_line,
            'has_delivery' => $this->provider->delivery,
            'provider_id' => $this->provider_id,
            'created_at' => $this->created_at,
        ];
    }
}
