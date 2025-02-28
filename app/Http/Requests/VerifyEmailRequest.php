<?php

namespace App\Http\Requests;


class VerifyEmailRequest extends APIRequest
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
            'verify_code' => 'required|string',
        ];
    }


    public function attributes()
    {
        return [
            'verify_code' => trans('api.verify_code'),
        ];
    }

}
