<?php

namespace App\Repository;

use App\Models\Contact;

class ContactUsRepository extends Repository
{
    protected $model;

    public function __construct(Contact $model)
    {
        $this->model = $model;
    }

}
