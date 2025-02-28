<?php

namespace App\Repository;

use App\Models\BranchStaff;

class BranchStaffRepository extends Repository
{
    protected $model;

    public function __construct(BranchStaff $model)
    {
        $this->model = $model;
    }

}
