<?php

namespace App\Http\Requests;


use App\Helper\OrderStatus;

class RateOrderRequest extends APIRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'order_id' => 'required',
            'value' => 'nullable',
            'comment' => 'nullable',
        ];
    }

}
