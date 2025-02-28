<?php

namespace App\Http\Requests;



class ProviderByCatRequest extends APIRequest
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

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'category_id'   => 'required|numeric|exists:categories,id',

        ];
    }

    public function attributes()
    {
        return [
            'category_id'     => trans('admin.category'),
        ];
    }


}
