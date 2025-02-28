<?php

namespace App\Http\Requests;




class FilterStaffRequest extends APIRequest
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
            'type'   => 'nullable|numeric|in:3,4',
            'branch_id'   => 'nullable|exists:branches,id',
        ];
    }

    public function attributes()
    {
        return [
            'type'   => trans('admin.type'),
        ];
    }


}
