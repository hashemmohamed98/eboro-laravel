<?php

namespace App\Models;

use App\InnerType;
use App\Mealoffer;
use App\Offer;
use App\ProviderType;
use App\Type;
use Illuminate\Database\Eloquent\Model;

class BranchProduct extends Model
{
    protected $guarded=[];
    protected $casts = [
        'position' => 'integer', // Assuming 'position' is an integer
    ];
    public function image()
    {
        if(isset($this->image) && $this->image != null)
            return $this->image;
        else
            return 'logo.jpeg';
    }

     public function branch()
    {
        return $this->belongsTo(Branch::class,'branch_id');
    }

    public function sauces()
    {
        return $this->hasMany(ProductSauce::class,'product_id');
    }

    public function sales()
    {
        return $this->hasMany(OrderProduct::class ,'product_id');
    }

    public function offer()
    {
        Offer::whereDate('start_at', '<', now())
            ->whereDate('end_at', '<', now())
            ->delete();
        return $this->hasOne(Offer::class ,'product_id');
    }

    public function Meal()
    {
        return $this->hasOne(Mealoffer::class ,'product_id');
    }
    public function typed()
    {
        return $this->belongsTo(InnerType::class,'type');
    }

    public function cart_product()
    {
        return $this->hasMany(Cart::class,'product_id');
    }

    public function cart_sauce()
    {
        return $this->hasMany(Cart::class,'sauce_id');
    }

}
