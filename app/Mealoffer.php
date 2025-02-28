<?php

namespace App;

use App\Models\Branch;
use App\Models\BranchProduct;
use App\Models\Provider;
use Illuminate\Database\Eloquent\Model;

class Mealoffer extends Model
{
    protected $guarded=[];

    public function product()
    {
        return $this->belongsTo(BranchProduct::class ,'product_id');
    }

    public function Meal_products()
    {
        return $this->hasMany(Mealproudacts::class ,'Meal_id');
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class ,'branch_id');
    }

    public function provider()
    {
        return $this->belongsTo(Provider::class ,'provider_id');
    }

}
