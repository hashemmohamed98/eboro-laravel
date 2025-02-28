<?php

namespace App\Http\Requests;


use App\Models\BranchStaff;

class EditBranchStaaffRequest extends APIRequest
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
        $user=BranchStaff::with('user')->find($this->id);
        return [
            'name' => 'nullable|string|max:20|min:3',
            'email' => 'nullable|email|unique:users,email,'.$user->user_id,
            'mobile'     => 'nullable|numeric|digits_between:5,25||unique:users,mobile,'.$user->user_id,
            'password'   => 'nullable|string|min:6|confirmed',
            'address'   => 'nullable|string',
            'image'   =>  'nullable|image|mimes:jpeg,png,jpg,svg,webp',
            'type'   => 'nullable|numeric|in:0,1,2,3,4,5',
            'branch_id'   => 'nullable|numeric|exists:branches,id',
        ];
    }

    public function attributes()
    {
        return [
            'name'     => trans('admin.name'),
            'mobile'     => trans('admin.mobile'),
            'email'     => trans('admin.email'),
            'password'   => trans('admin.password'),
            'address'   => trans('api.address'),
            'image'   => trans('api.image'),
            'type'   => trans('admin.type'),
        ];
    }


}
