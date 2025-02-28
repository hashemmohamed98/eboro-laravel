<?php

namespace App\Http\Requests;



class AddToRateRequest extends APIRequest
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
            'provider_id'   => 'required|numeric|exists:providers,id',
            'value'   => 'required|numeric',
            'comment'   => 'nullable|string',
            'type'   => 'nullable|in:client,vendor,rider',
        ];
    }

    public function validated($key = null, $default = null)
    {
        return data_get(array_merge($this->validator->validated(), [
            'user_id' => auth()->id(),
        ]), $key, $default);
    }

}
