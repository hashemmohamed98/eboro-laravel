<?php

namespace App\Http\Requests;



use App\Helper\UploadImages;

class CategoryRequest extends APIRequest
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
            'name_en' => 'required|string|max:20|min:3',
            'name_it' => 'required|string|max:20|min:3',
            'image'   =>  'nullable|image|mimes:jpeg,png,jpg,svg,webp',
        ];
    }

    public function attributes()
    {
        return [
            'name_en'     => trans('admin.name_en'),
            'name_it'     => trans('admin.name_it'),
            'image'   => trans('api.image'),
        ];
    }


}
