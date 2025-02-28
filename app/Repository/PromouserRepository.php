<?php

namespace App\Repository;

use App\Promouser;

class PromouserRepository extends Repository
{
    protected $model;

    public function __construct(Promouser $model)
    {
        $this->model = $model;
    }
}
