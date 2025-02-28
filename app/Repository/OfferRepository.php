<?php

namespace App\Repository;

use App\Models\Favorite;
use App\Offer;

class OfferRepository extends Repository
{
    protected $model;

    public function __construct(Offer $model)
    {
        $this->model = $model;
    }

}
