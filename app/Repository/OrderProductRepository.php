<?php

namespace App\Repository;

use App\Models\OrderProduct;

class OrderProductRepository extends Repository
{
    protected $model;

    public function __construct(OrderProduct $model)
    {
        $this->model = $model;
    }


}
