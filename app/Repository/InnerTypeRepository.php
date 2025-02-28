<?php

namespace App\Repository;

use App\InnerType;

class InnerTypeRepository extends Repository
{
    protected $model;

    public function __construct(InnerType $model)
    {
        $this->model = $model;
    }
}
