<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class OrderLog extends Model
{
    protected $guarded=[];

    public function order()
    {
        return $this->belongsTo(Order::class,'order_id');
    }

    public function delivery()
    {
        return $this->belongsTo(User::class,'delivery_id');
    }
}
