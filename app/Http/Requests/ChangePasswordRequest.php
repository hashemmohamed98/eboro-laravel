<?php

namespace App\Http\Requests;


class ChangePasswordRequest extends APIRequest
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
            'password'   => 'required|string|min:6|confirmed',
            'old_password'   => 'required|string|min:6',
        ];
    }


    public function attributes()
    {
        return [
            'password'=>trans('admin.password'),
            'old_password'=>trans('api.old_password'),
        ];
    }

}
