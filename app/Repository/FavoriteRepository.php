<?php

namespace App\Repository;

use App\Models\Favorite;

class FavoriteRepository extends Repository
{
    protected $model;

    public function __construct(Favorite $model)
    {
        $this->model = $model;
    }

}
