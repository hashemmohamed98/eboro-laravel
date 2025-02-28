<?php

namespace App\Http\Requests;


class EditSettingRequest extends APIRequest
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
            'logo'   =>  'nullable|image|mimes:jpeg,png,jpg,svg,webp',
            'slider_image'   =>  'nullable|image|mimes:jpeg,png,jpg,svg,webp',
            'state'   => 'nullable|in:open,close',
            'state_message_en' => 'nullable|string|min:3',
            'state_message_it' => 'nullable|string|min:3',
            'description_en' => 'nullable|string|min:3',
            'description_it' => 'nullable|string|min:3',
            'android_link' => 'nullable|string|min:3',
            'iOS_link' => 'nullable|string|min:3',
            'tax' => 'nullable|numeric',
            'Dli_time' => 'nullable|numeric',
            'shipping' => 'nullable|numeric',
            'shipping2' => 'nullable|numeric',
            'min_shipping' => 'nullable|numeric',
            'range' => 'nullable|numeric',
            'avg_prepare' => 'nullable|numeric',
            'de_start' => 'nullable|numeric',
            'de_per_km' => 'nullable|numeric',
            'providers_array' => 'nullable',
            'product_array' => 'nullable',
            'product_offer_array' => 'nullable',
            'facebook' => 'nullable',
            'twitter' => 'nullable',
            'linkedin' => 'nullable',
            'youtube' => 'nullable',
            'about_en' => 'nullable|string|min:3',
            'about_it' => 'nullable|string|min:3',
            'privacy_en' => 'nullable|string|min:3',
            'privacy_it' => 'nullable|string|min:3',
            'contact_email_1' => 'nullable|string|min:3',
            'contact_email_2' => 'nullable|string|min:3',
            'contact_email_3' => 'nullable|string|min:3',
            'contact_map' => 'nullable|string|min:3',
            'email' => 'nullable|string|min:3',
            'phone' => 'nullable|string|min:3',
        ];
    }

    public function attributes()
    {
        return [
            'name'     => trans('admin.name'),
        ];
    }


}
