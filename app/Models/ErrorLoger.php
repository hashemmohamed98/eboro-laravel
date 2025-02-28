<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ErrorLoger extends Model
{
    protected $guarded = [];

    protected $casts = [
        'request' => 'array',
    ];
}
