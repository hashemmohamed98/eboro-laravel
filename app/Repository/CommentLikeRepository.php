<?php

namespace App\Repository;

use App\Models\CommentLike;

class CommentLikeRepository extends Repository
{
    protected $model;

    public function __construct(CommentLike $model)
    {
        $this->model = $model;
    }

}
