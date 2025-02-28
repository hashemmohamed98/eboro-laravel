<?php

namespace App\Repository;

use App\Models\Comment;

class CommentRepository extends Repository
{
    protected $model;

    public function __construct(Comment $model)
    {
        $this->model = $model;
    }

}
