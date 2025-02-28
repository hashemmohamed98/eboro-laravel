<?php

namespace App\Repository;

use App\Models\Cart;

class CartRepository extends Repository
{
    protected $model;

    public function __construct(Cart $model)
    {
        $this->model = $model;
    }

}
