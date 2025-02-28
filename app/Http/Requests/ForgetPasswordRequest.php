<?php

namespace App\Http\Requests;


class ForgetPasswordRequest extends APIRequest
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
            'email'     => 'required|email',
        ];
    }

    public function attributes()
    {
        return [
            'email'=>trans('admin.email'),
        ];
    }

}
