<?php

namespace App\Repository;

use App\ProviderTypeInner;

class ProviderTypeInnerRepository extends Repository
{
    protected $model;

    public function __construct(ProviderTypeInner $model)
    {
        $this->model = $model;
    }
}
