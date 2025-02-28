<?php

namespace App\Repository;

use App\Models\User;
use App\Setting;
use Illuminate\Support\Facades\Hash;

class SettingRepository extends Repository
{
    protected $model;

    public function __construct(Setting $model)
    {
        $this->model = $model;
    }

}
