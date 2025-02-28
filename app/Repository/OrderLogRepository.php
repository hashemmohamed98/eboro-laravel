<?php

namespace App\Repository;

use App\Models\OrderLog;

class OrderLogRepository extends Repository
{
    protected $model;

    public function __construct(OrderLog $model)
    {
        $this->model = $model;
    }

}
