<?php

namespace App\Http\Requests;


class EditProfileRequest extends APIRequest
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
            'email' => 'nullable|email|unique:users,email,'.auth()->id(),
            'mobile'     => 'nullable|unique:users,mobile,'.auth()->id(),
            'password'   => 'nullable|string|min:6|confirmed',
            'address'   => 'nullable|string',
            'lat'   => 'nullable|string',
            'long'   => 'nullable|string',
            'online'   => 'nullable|in:0,1',
            'image'   =>  'nullable|image|mimes:jpeg,png,jpg,svg,webp',
        ];
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
        ];
    }


}
