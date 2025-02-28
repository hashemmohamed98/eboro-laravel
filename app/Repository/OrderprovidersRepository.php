<?php

namespace App\Repository;

use App\Ordermultipleprovider;

class OrderprovidersRepository extends Repository
{
    protected $model;

    public function __construct(Ordermultipleprovider $model)
    {
        $this->model = $model;
    }

}
