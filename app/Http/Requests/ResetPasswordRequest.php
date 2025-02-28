<?php

namespace App\Http\Requests;


class ResetPasswordRequest extends APIRequest
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
            'password' => 'required|string|min:6|confirmed',
            'verify_code' => 'required|string',
            'email' => 'required|email',
        ];
    }


    public function attributes()
    {
        return [
            'password' => trans('admin.password'),
            'verify_code' => trans('api.verify_code'),
            'mobile' => trans('admin.mobile'),
        ];
    }

}
