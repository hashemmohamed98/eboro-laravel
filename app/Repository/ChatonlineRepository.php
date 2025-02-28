<?php

namespace App\Repository;

use App\Chatonline;

class ChatonlineRepository extends Repository
{
    protected $model;

    public function __construct(Chatonline $model)
    {
        $this->model = $model;
    }

}
