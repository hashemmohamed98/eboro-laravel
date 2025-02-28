<?php

namespace App\Http\Resources;

use App\Http\Controllers\SiteController;
use App\Models\Rate;
use App\Type;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\App;

class TypesProviderRescource extends JsonResource
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
            'type' =>  new TypesRescource($this->type),
            'created_at' => $this->created_at,
        ];
    }
}
