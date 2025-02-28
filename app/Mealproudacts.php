<?php

namespace App;

use App\Models\Branch;
use App\Models\BranchProduct;
use App\Models\Provider;
use Illuminate\Database\Eloquent\Model;

class Mealproudacts extends Model
{
    protected $guarded=[];

    public function product()
    {
        return $this->belongsTo(BranchProduct::class ,'product_id');
    }
}
