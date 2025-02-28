<?php

namespace App\Repository;

use App\Type;

class TypeRepository extends Repository
{
    protected $model;

    public function __construct(Type $model)
    {
        $this->model = $model;
    }
}
