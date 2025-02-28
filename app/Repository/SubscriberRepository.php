<?php

namespace App\Repository;


use App\Models\Subscriber;

class SubscriberRepository extends Repository
{
    protected $model;

    public function __construct(Subscriber $model)
    {
        $this->model = $model;
    }

}
