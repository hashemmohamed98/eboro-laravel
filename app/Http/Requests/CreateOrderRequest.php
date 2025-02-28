<?php

namespace App\Http\Requests;


class CreateOrderRequest extends APIRequest
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
            'drop_lat' => 'required',
            'drop_long' => 'required',
            'drop_address' => 'required',
            'payment' => 'nullable|in:0,1,2',
            'ordar_at' => 'nullable',
            'gratuity' => 'nullable',
            'options' => 'nullable',
            'card_number' => 'required_if:payment,1',
            'card_date' => 'required_if:payment,1',
            'card_cvv' => 'required_if:payment,1',
            'comment' => 'nullable',
        ];
    }

    public function validated($key = null, $default = null)
    {
        return data_get(array_merge($this->validator->validated(), [
            'user_id' => auth()->id(),
        ]), $key, $default);
    }
}
