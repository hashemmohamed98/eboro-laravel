<?php

namespace App\Http\Requests;


use App\Helper\UploadImages;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ContactUsRequest extends FormRequest
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
            'phone' => 'nullable|numeric|digits_between:5,25',
            'email' => 'required|email|min:10|max:75',
            'subject' => 'nullable|string|max:25|min:3',
            'message' => 'required|string|max:2000',
            'file' => 'nullable',
        ];
    }

    public function validated($key = null, $default = null)
    {
        return data_get(array_merge($this->validator->validated(), [
            'file' => isset($this->file) ? UploadImages::UploadFile($this->file, 'Contact') : null,
        ]), $key, $default);
    }

    public function attributes()
    {
        return [
            'name' => trans('admin.name'),
            'phone' => trans('admin.phone'),
            'email' => trans('admin.email'),
            'subject' => trans('admin.subject'),
            'message' => trans('admin.message'),
            'file' => trans('admin.file'),
        ];
    }
}
