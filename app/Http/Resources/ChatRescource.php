<?php

namespace App\Http\Resources;

use App\Models\Rate;
use Illuminate\Http\Resources\Json\JsonResource;

class ChatRescource extends JsonResource
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
//            'order' => new OrderRescource($this->Order),
            'user' => new UserRescource($this->User),
            'Message' => $this->text,
            'created_at' => $this->created_at->diffForHumans(),
        ];
    }
}
