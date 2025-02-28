<?php

namespace App\Http\Requests;


use App\Helper\UploadImages;
use Illuminate\Foundation\Http\FormRequest;

class DeliveryRegisterRequest extends FormRequest
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
            'mobile' => 'required|numeric|unique:users,mobile|digits_between:5,25',
            'password' => 'required|string|min:6|confirmed',
            'address' => 'required|string',
            'lat' => 'nullable|string',
            'long' => 'nullable|string',
            'city' => 'nullable|string',
            'country' => 'nullable|string',
            'postal_code' => 'nullable|string',
            'nationality' => 'nullable|string',
            'image' =>  'nullable|image|mimes:jpeg,png,jpg,svg,webp',
            'front_id_image' =>  'nullable|image|mimes:jpeg,png,jpg,svg,webp',
            'back_id_image' =>  'nullable|image|mimes:jpeg,png,jpg,svg,webp',
            'license_image' =>  'nullable|image|mimes:jpeg,png,jpg,svg,webp',
            'license_expire' =>  'nullable|image|mimes:jpeg,png,jpg,svg,webp',
        ];
    }

    public function validated($key = null, $default = null)
    {
        if ($this->image) {
            return data_get(array_merge($this->validator->validated(), [
                'image' => UploadImages::upload($this->image, 'User'),
            ]), $key, $default);
        }
        return data_get($this->validator->validated(), $key, $default);
    }

    public function attributes()
    {
        return [
            'name' => trans('admin.name'),
            'mobile' => trans('admin.mobile'),
            'email' => trans('admin.email'),
            'password' => trans('admin.password'),
            'address' => trans('api.address'),
            'image' => trans('api.image'),
            'type' => trans('admin.type'),
        ];
    }


}
