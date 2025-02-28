<?php

namespace App\Http\Requests;



class BranchRequest extends APIRequest
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
            'address' => 'required|string',
            'lat' => 'required|string',
            'long' => 'required|string',
            'hot_line' => 'nullable',
            'open_time' => 'nullable',
            'close_time' => 'nullable',
            'open_days' => 'nullable',
            'parent' => 'nullable',
            'description' => 'nullable|string',
            'status' => 'required|int',
            'provider_id'   => 'required|numeric|exists:providers,id',

        ];
    }

    public function attributes()
    {
        return [
            'name'     => trans('admin.name'),
            'description'     => trans('admin.description'),
            'address'   => trans('admin.address'),
            'lat'   => trans('admin.lat'),
            'long'   => trans('admin.long'),
            'hot_line'   => trans('admin.hot_line'),
            'open_time'   => trans('admin.open_time'),
            'close_time'   => trans('admin.close_time'),
            'parent' => trans('admin.parent'),
            'status'   => trans('admin.status'),
            'open_days'   => trans('admin.open_days'),
        ];
    }


}
