<?php

namespace App\Repository;

use App\Models\Provider;

class ProviderRepository extends Repository
{
    protected $model;

    public function __construct(Provider $model)
    {
        $this->model = $model;
    }

}
