<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $guarded = [];
    protected $casts = [
        'sauce_ids'=>'json'
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
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
