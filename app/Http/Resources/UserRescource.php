<?php

namespace App\Http\Resources;

use App\Helper\UsersType;
use Illuminate\Http\Resources\Json\JsonResource;

class UserRescource extends JsonResource
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
            'mobile' => $this->mobile,
            'email' => $this->email,
            'image' => $this->image?url('public/uploads/User/'.$this->image):'',
            'front_id_image' => $this->front_id_image?url('public/uploads/Delivery/'.$this->front_id_image):'',
            'back_id_image' => $this->back_id_image?url('public/uploads/Delivery/'.$this->back_id_image):'',
            'license_image' => $this->license_image?url('public/uploads/Delivery/'.$this->license_image):'',
            'license_expire' => $this->license_expire?url('public/uploads/Delivery/'.$this->license_expire):'',
            'address' => $this->address,
            'house' => $this->house,
            'intercom' => $this->intercom,
            'verify_code' => $this->verify_code,
            'type' => UsersType::getType($this->type),
            'lat' => $this->lat,
            'long' => $this->long,
            'online' => $this->online,
            'created_at' => $this->created_at,
        ];
    }
}

