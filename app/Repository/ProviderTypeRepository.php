<?php

namespace App\Repository;

use App\ProviderType;

class ProviderTypeRepository extends Repository
{
    protected $model;

    public function __construct(ProviderType $model)
    {
        $this->model = $model;
    }
}
