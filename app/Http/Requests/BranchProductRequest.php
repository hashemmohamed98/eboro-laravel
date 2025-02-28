<?php

namespace App\Http\Requests;


use App\Helper\UploadImages;

class BranchProductRequest extends APIRequest
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
            'price'     => 'required|numeric',
            'position'     => 'nullable|numeric',
//            'price'     => 'required|regex:/^\d+(\.\d+)?(\,\d+(\.\d+)?)*$/',
            'description'   => 'nullable|string',
            'type'   => 'nullable',
            'has_pig'   => 'nullable|boolean',
            'has_alcohol'   => 'nullable|boolean',
            'has_outofstock'   => 'nullable|boolean',
            'start_outofstock'   => 'nullable',
            'end_outofstock'   => 'nullable',
            'value'   => 'nullable',
            'start_at'   => 'nullable',
            'end_at'   => 'nullable',
            'additions'   => 'nullable',
            'calories'   => 'nullable',
            'size'   => 'nullable',
            'publish_at'   => 'nullable',
            'product_type'   => 'nullable|in:Food,Sauce,Addition',
            'image'   =>  'nullable|image|mimes:jpeg,png,jpg,svg,webp',
            'branch_id'   => 'required|numeric|exists:branches,id',
        ];
    }

    public function validated($key = null, $default = null)
    {
        return data_get(array_merge($this->validator->validated(), [
            'image' => isset($this->image) ? UploadImages::upload($this->image, 'Product') : null,
            'has_pig' => ($this['has_pig'] ? 1 : 0 ) ?? 0,
            'has_alcohol' => ($this['has_alcohol'] ? 1 : 0) ?? 0,
            'has_outofstock' => ($this['has_outofstock'] ? 1 : 0) ?? 0,
        ]), $key, $default);
    }

    public function attributes()
    {
        return [
            'name'     => trans('admin.name'),
            'description'     => trans('admin.description'),
            'has_alcohol'     => trans('admin.has_alcohol'),
            'has_pig'   => trans('admin.has_pig'),
            'has_outofstock'   => trans('admin.has_outofstock'),
            'start_outofstock'   => trans('admin.start_outofstock'),
            'end_outofstock'   => trans('admin.end_outofstock'),
            'value'   => trans('admin.offer_value'),
            'start_at'   => trans('admin.offer_start'),
            'end_at'   => trans('admin.offer_end'),
            'publish_at'   => trans('admin.publish_at'),
            'additions'   => trans('api.additions'),
            'image'   => trans('api.image'),
            'type'   => trans('admin.type'),
            'calories'   => trans('admin.calories'),
            'size'   => trans('admin.size'),
            'product_type'   => trans('admin.product_type'),
        ];
    }


}
