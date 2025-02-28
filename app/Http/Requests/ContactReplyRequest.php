<?php

namespace App\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;

class ContactReplyRequest extends FormRequest
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
            're_message' => 'required|string',
        ];
    }

    public function validated($key = null, $default = null)
    {
        return data_get(array_merge($this->validator->validated(), [
            'state' => 'closed',
        ]), $key, $default);
    }


    public function attributes()
    {
        return [
            're_message'=>trans('admin.reply'),
        ];
    }
}
