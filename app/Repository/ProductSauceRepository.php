<?php

namespace App\Repository;

use App\Models\ProductSauce;

class ProductSauceRepository extends Repository
{
    protected $model;

    public function __construct(ProductSauce $model)
    {
        $this->model = $model;
    }

}
