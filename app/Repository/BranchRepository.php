<?php

namespace App\Repository;

use App\Models\Branch;

class BranchRepository extends Repository
{
    protected $model;

    public function __construct(Branch $model)
    {
        $this->model = $model;
    }

}
