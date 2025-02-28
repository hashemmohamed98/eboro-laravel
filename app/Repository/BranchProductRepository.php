<?php

namespace App\Repository;

use App\Models\BranchProduct;

class BranchProductRepository extends Repository
{
    protected $model;

    public function __construct(BranchProduct $model)
    {
        $this->model = $model;
    }

}
