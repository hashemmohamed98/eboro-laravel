<?php

namespace App\Repository;

use App\Calendar;

class CalendarRepository extends Repository
{
    protected $model;

    public function __construct(Calendar $model)
    {
        $this->model = $model;
    }
}
