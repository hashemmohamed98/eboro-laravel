<?php

namespace App\Repository;

use App\Models\Testmonial;

class TestmonialRepository extends Repository
{
    protected $model;

    public function __construct(Testmonial $model)
    {
        $this->model = $model;
    }
}
