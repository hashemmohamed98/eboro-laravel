<?php

namespace App\Repository;

use App\Models\Contact;
use Illuminate\Support\Facades\Hash;

class ContactRepository extends Repository
{
    protected $model;

    public function __construct(Contact $model)
    {
        $this->model = $model;
    }

}
