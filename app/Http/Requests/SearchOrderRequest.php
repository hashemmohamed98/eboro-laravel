<?php

namespace App\Http\Requests;


use App\Helper\OrderStatus;

class SearchOrderRequest extends APIRequest
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
            'user_id' => 'nullable|exists:users,id',
            'delivery_id' => 'nullable',
            'cashier_id' => 'nullable',
            'branch_id' => 'nullable',
            'id' => 'nullable|exists:orders,id',
            'status' => 'nullable|in_array:'.json_encode(OrderStatus::arr),
        ];
    }

    public function validated($key = null, $default = null)
    {
        return data_get(array_merge($this->validator->validated(), [
            'user_id' => auth()->id(),
        ]), $key, $default);
    }

}
