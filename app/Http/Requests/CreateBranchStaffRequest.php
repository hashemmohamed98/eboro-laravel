<?php

namespace App\Http\Requests;



use App\Helper\UploadImages;

class CreateBranchStaffRequest extends APIRequest
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
            'mobile'     => 'required|numeric|unique:users,mobile|digits_between:5,25',
            'password'   => 'required|string|min:6|confirmed',
            'address'   => 'nullable|string',
            'image'   =>  'nullable|image|mimes:jpeg,png,jpg,svg,webp',
            'type'   => 'required|numeric|in:3,4,5',
            'branch_id'   => 'required|exists:branches,id',
        ];
    }

    public function validated($key = null, $default = null)
    {
        if ($this->image) {
            return data_get(array_merge($this->validator->validated(), [
                'image' =>UploadImages::upload($this->image, 'User'),
            ]), $key, $default);
        } else {
            return data_get($this->validator->validated(), $key, $default);
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
        ];
    }


}
