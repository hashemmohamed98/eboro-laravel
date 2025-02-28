<?php

namespace App\Http\Resources;

use App\Helper\UsersType;
use App\Models\BranchStaff;
use Illuminate\Http\Resources\Json\JsonResource;

class BranchStaffRescource extends JsonResource
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
            'name' => $this->user->name,
            'mobile' => $this->user->mobile,
            'email' => $this->user->email,
            'image' => $this->user->image?url('public/uploads/User/'.$this->user->image):'',
            'address' => $this->user->address,
            'type' => UsersType::getType($this->user->type),
            'branch' => new BranchRescource($this->branch),
            'created_at' => $this->created_at,
        ];
    }
}
