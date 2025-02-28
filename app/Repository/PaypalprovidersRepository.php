<?php

namespace App\Repository;

use App\Ordermultipleprovider;
use App\Paypalorder;

class PaypalprovidersRepository extends Repository
{
    protected $model;

    public function __construct(Paypalorder $model)
    {
        $this->model = $model;
    }

}
