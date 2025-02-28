<?php

namespace App\Repository;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class UserRepository extends Repository
{
    protected $model;

    public function __construct(User $model)
    {
        $this->model = $model;
    }

    public function register($data)
    {
        $data['email_verified_at'] = Carbon::now();
        return $this->model->create($data);
    }

    public function checkPassword($user,$data)
    {
        if (Hash::check($data['old_password'], $user->password)) {
            $user->update(['password' => bcrypt($data['password'])]);
            return true;
        } else {
            return false;
        }
    }

}
