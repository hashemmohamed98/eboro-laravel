<?php

namespace App\Repository;

use App\Mealoffer;

class MealofferRepository extends Repository
{
    protected $model;

    public function __construct(Mealoffer $model)
    {
        $this->model = $model;
    }

}
