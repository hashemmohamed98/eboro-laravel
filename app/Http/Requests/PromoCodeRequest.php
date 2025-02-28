<?php

namespace App\Http\Requests;



use App\Helper\UploadImages;

class PromoCodeRequest extends APIRequest
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
            'type' => 'required',
            'max_offer' => 'required',
            'HMUser' => 'required',
            'HMTime_used' => 'required',
            'start_at' => 'required',
            'end_at' => 'required',
        ];
    }

    public function attributes()
    {
        return [
            'type'     => trans('admin.promos.type'),
            'max_offer'     => trans('admin.promos.max_offer'),
            'HMUser'     => trans('admin.promos.HMUser'),
            'HMTime_used'     => trans('admin.promos.HMTime_used'),
            'start_at'     => trans('admin.promos.start_at'),
            'end_at'     => trans('admin.promos.end_at'),
        ];
    }


}
