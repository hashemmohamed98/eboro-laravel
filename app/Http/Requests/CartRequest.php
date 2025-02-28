<?php

namespace App\Http\Requests;


class CartRequest extends APIRequest
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
            'sauce_ids' => 'nullable',
//            'sauce_id' => 'nullable|numeric|exists:branch_products,id',
            'product_id' => 'required|numeric|exists:branch_products,id',
            'qty' => 'nullable|numeric',
        ];
    }

    public function validated($key = null, $default = null)
    {
        return data_get(array_merge($this->validator->validated(), [
            'user_id' => auth()->id(),
        ]), $key, $default);
    }

}
