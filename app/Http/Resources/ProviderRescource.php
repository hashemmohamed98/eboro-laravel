<?php

namespace App\Http\Resources;

use App\Http\Controllers\SiteController;
use App\Models\Rate;
use App\Type;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\App;

class ProviderRescource extends JsonResource
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
            'vip' => $this->vip,
            'rate' => number_format( (float) Rate::where(["provider_id" => $this->id])->selectRaw('SUM(value)/COUNT(user_id) As value')->first()->value??5, 2, '.', ''),
            'rateRatio' => number_format( (float) (Rate::where(["provider_id" => $this->id])->selectRaw('SUM(value)/COUNT(user_id) As value')->first()->value/5)*100??100, 0, '.', ''),
            'rate_user' =>  Rate::where(["provider_id" => $this->id])->selectRaw('COUNT(user_id) As value')->first()->value."",
            'Delivery' => SiteController::userDis($this->id)??0,
//            'Delivery' => SiteController::distance2(0 , 0, "need" , $this->id),
            'has_delivery' => $this->delivery,
            'type' => TypesProviderRescource::collection($this->typed),
            'typeInner' => TypesProviderRescource::collection($this->typeInner),
            'offer' => (SiteController::has_offer($this->id,false)),
            'description' => $this->description,
            'duration' => $this->duration,
            'state' => SiteController::check_state($this->id),
            'lock' => $this->lock,
            'category' => new CategoryRescource($this->category),
            'logo' => $this->logo?url('public/uploads/Provider/'.$this->logo):'',
            'user' => new UserRescource($this->user),
            'created_at' => $this->created_at,
        ];
    }
}
