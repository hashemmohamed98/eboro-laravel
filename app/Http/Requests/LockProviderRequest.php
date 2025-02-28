<?php

namespace App\Http\Requests;



use App\Helper\OrderStatus;

class LockProviderRequest extends APIRequest
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
            'id' => 'required',
            'lock' => 'required|in:lock,unlock',
        ];
    }

    public function validated($key = null, $default = null)
    {
            return data_get(array_merge($this->validator->validated(), [
                'user_id' =>auth()->id(),
            ]), $key, $default);
    }

}
