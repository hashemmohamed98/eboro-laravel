<?php

namespace App\Http\Requests;



class ProductSauceRequest extends APIRequest
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
            'sauce_id'   => 'required|numeric|exists:branch_products,id',
            'product_id'   => 'required|numeric|exists:branch_products,id',
        ];
    }


}
