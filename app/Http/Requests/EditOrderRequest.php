<?php

namespace App\Http\Requests;


use App\Helper\OrderStatus;

class EditOrderRequest extends APIRequest
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
            'delivery_id' => 'nullable|exists:users,id',
            'cashier_id' => 'nullable|exists:branch_staff,id',
            'order_id' => 'required|exists:orders,id',
            'ordar_at' => 'nullable',
            'status' => 'nullable',
            'drop_address' => 'nullable',
            'refuse_reason' => 'required_if:status,'.OrderStatus::UserNotFound.','.OrderStatus::Cancelled,
        ];
    }

}
