<?php

namespace App\Http\Requests;


class FilterBranchProductRequest extends APIRequest
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
            'name' => 'nullable|string|max:20|min:3',
            'price_to' => 'nullable|numeric',
            'price_from' => 'nullable|numeric',
            'type' => 'nullable',
            'product_type' => 'nullable|in:Food,Sauce,Addition',
            'branch_id' => 'nullable|numeric|exists:branches,id',
            'provider_id' => 'nullable|numeric|exists:providers,id',
        ];
    }

    public function attributes()
    {
        return [
            'name' => trans('admin.name'),
            'description' => trans('admin.description'),
            'way' => trans('admin.way'),
            'steps' => trans('admin.steps'),
            'additions' => trans('api.additions'),
            'image' => trans('api.image'),
            'type' => trans('admin.type'),
            'calories' => trans('admin.calories'),
            'size' => trans('admin.size'),
            'product_type' => trans('admin.product_type'),
        ];
    }


}
