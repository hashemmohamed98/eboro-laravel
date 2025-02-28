<?php

namespace App\Repository;

use App\Promocode;

class PromocodeRepository extends Repository
{
    protected $model;

    public function __construct(Promocode $model)
    {
        $this->model = $model;
    }
}
