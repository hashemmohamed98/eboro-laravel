<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{
    protected $guarded=[];
    protected $casts = [
        'sauce_ids'=>'json',
        'qty'=>'integer'
    ];
    public function order()
    {
        return $this->belongsTo(Order::class,'order_id');
    }

    public function product()
    {
        return $this->belongsTo(BranchProduct::class,'product_id');
    }

    public function sauce()
    {
        return $this->belongsTo(BranchProduct::class,'sauce_id');
    }
}
