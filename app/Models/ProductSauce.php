<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductSauce extends Model
{
    protected $guarded=[];

    public function product()
    {
        return $this->belongsTo(BranchProduct::class,'product_id');
    }

    public function sauce()
    {
        return $this->belongsTo(BranchProduct::class,'sauce_id');
    }
}
