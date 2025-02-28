<?php

namespace App;

use App\Models\Branch;
use App\Models\BranchProduct;
use App\Models\Provider;
use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    protected $guarded=[];


    public function product()
    {
        return $this->belongsTo(BranchProduct::class ,'product_id');
    }

    public function branch()
    {
        return $this->hasMany(Branch::class ,'branch_id');
    }

    public function provider()
    {
        return $this->hasMany(Provider::class ,'provider_id');
    }

}
