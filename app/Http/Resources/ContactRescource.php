<?php

namespace App\Http\Resources;

use App\Helper\UsersType;
use Illuminate\Http\Resources\Json\JsonResource;

class ContactRescource extends JsonResource
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
            'phone' => $this->phone,
            'email' => $this->email,
            'subject' => $this->subject,
            'message' => $this->message,
            'reply' => $this->re_message,
            'state' =>$this->state,
            'created_at' => $this->created_at,
        ];
    }
}
