<?php

namespace App\Http\Requests;


class ChatRequest extends APIRequest
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

    public function rules()
    {
        return [
            'order_id' => 'required|numeric',
            'text' => 'required',
        ];
    }

    public function validated($key = null, $default = null)
    {
        return data_get(array_merge($this->validator->validated(), [
            'user_id' => auth()->id(),
        ]), $key, $default);
    }

}
