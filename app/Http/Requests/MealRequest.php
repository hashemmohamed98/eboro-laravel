<?php

namespace App\Http\Requests;


class MealRequest extends APIRequest
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
            'value' => 'required|numeric',
            'products' => 'required',
            'amounts' => 'required',
            'start_at' => 'required',
            'end_at' => 'required',
        ];
    }

    public function validated($key = null, $default = null)
    {
        return data_get(array_merge($this->validator->validated(), [
            'user_id' => auth()->id(),
        ]), $key, $default);
    }

    public function attributes()
    {
        return [
            'value'   => 'Amount',
            'start_at'   => trans('admin.offer_start'),
            'end_at'   => trans('admin.offer_end'),
        ];
    }

}
