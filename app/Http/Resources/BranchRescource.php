<?php

namespace App\Http\Resources;

use App\Http\Controllers\SiteController;
use Illuminate\Http\Resources\Json\JsonResource;

class BranchRescource extends JsonResource
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
            'description' => $this->description,
            'address' => $this->address,
            'lat' => $this->lat,
            'long' => $this->long,
            'open_days' => $this->open_days,
            'open_time' => $this->open_time,
            'close_time' => $this->close_time,
            'status' => $this->status==0?"open":"close",
            'has_delivery' => $this->provider->delivery,
            'hot_line' => $this->hot_line,
            'provider' => new ProviderRescource($this->provider),
            'created_at' => $this->created_at,
        ];
    }
}
