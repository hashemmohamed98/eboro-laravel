<?php

namespace App\Http\Requests;



use App\Helper\OrderStatus;

class ProviderRequest extends APIRequest
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
            'name' => 'required|string|max:20|min:3',
            'description' => 'required|string',
            'category_id'   => 'required|numeric|exists:categories,id',
            'logo'   =>  'nullable|image|mimes:jpeg,png,jpg,svg,webp',
            'types' => 'required',
            'delivery' => 'nullable',
            'vip' => 'nullable',
            'duration' => 'required',
            'range_delivery' => 'required_if:delivery,1',
            'delivery_fee' => 'required_if:delivery,1',
        ];
    }

    public function validated($key = null, $default = null)
    {
            return data_get(array_merge($this->validator->validated(), [
                'user_id' =>auth()->id(),
            ]), $key, $default);
    }

    public function attributes()
    {
        return [
            'name'     => trans('admin.name'),
            'description'     => trans('admin.description'),
            'logo'   => trans('admin.image'),
        ];
    }


}
