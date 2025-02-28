<?php

namespace App\Repository;

use App\Models\Rate;

class RateRepository extends Repository
{
    protected $model;

    public function __construct(Rate $model)
    {
        $this->model = $model;
    }

}
