<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CommentLike extends Model
{
    protected $guarded=[];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function Comment()
    {
        return $this->belongsTo(Comment::class,'comment_id');
    }
}
