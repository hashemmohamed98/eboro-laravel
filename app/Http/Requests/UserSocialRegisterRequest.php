<?php

namespace App\Http\Requests;
use App\Helper\RandomCode;
use App\Helper\UploadImages;
use Carbon\Carbon;
use Image;

class UserSocialRegisterRequest extends APIRequest
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
            'Social_id'   => 'required',
            'name' => 'required|string|max:20|min:3',
            'email' => 'required|email|unique:users,email',
            'image'   => 'nullable',
            'flag'   => 'required|numeric|in:1,2',
        ];
    }

    public function validated($key = null, $default = null)
    {
        if ($this->image) {
            $path = $this->image;
            $filename = sha1(random_int(1, 5000) * (float)microtime()) . '.' . ".jpg";
            Image::make($path)->save(public_path('uploads/User/' . $filename));
            return data_get(array_merge($this->validator->validated(), [
                'image' => $filename,
                'password' => bcrypt(RandomCode::getToken(8)),
            ]), $key, $default);
        } else {
            return data_get(array_merge($this->validator->validated(), [
                'password' => bcrypt(RandomCode::getToken(8)),
            ]), $key, $default);
        }
    }
    public function attributes()
    {
        return [
            'name'     => trans('admin.name'),
            'email'     => trans('admin.email'),
            'image'   => trans('api.image'),
            'type'   => trans('admin.type'),
        ];
    }


}
