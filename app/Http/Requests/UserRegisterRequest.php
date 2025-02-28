<?php

namespace App\Http\Requests;



use App\Helper\RandomCode;
use App\Helper\UploadImages;

class UserRegisterRequest extends APIRequest
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
            'email' => 'required|email|unique:users,email',
            'mobile'     => 'required|unique:users,mobile',
            'password'   => 'required|string|min:6|confirmed',
            'address'   => 'nullable|string',
            'image'   => 'nullable',
//            'image'   =>  'nullable|image|mimes:jpeg,png,jpg,svg,webp',
            'type'   => 'nullable|numeric|in:0,1,2,3,4,5',
        ];
    }

    public function validated($key = null, $default = null)
    {
        if ($this->image) {
            return data_get(array_merge($this->validator->validated(), [
                'image' =>UploadImages::upload($this->image, 'User'),
                'verify_code' =>RandomCode::getToken(6),
            ]), $key, $default);
        } else {
            return data_get(array_merge($this->validator->validated(), [
                'verify_code' =>RandomCode::getToken(6),
            ]), $key, $default);
        }
    }

    public function attributes()
    {
        return [
            'name'     => trans('admin.name'),
            'mobile'     => trans('admin.mobile'),
            'email'     => trans('admin.email'),
            'password'   => trans('admin.password'),
            'address'   => trans('api.address'),
            'image'   => trans('api.image'),
            'type'   => trans('admin.type'),
        ];
    }


}
