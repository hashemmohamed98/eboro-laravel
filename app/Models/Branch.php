<?php

namespace App\Models;

use App\Helper\UsersType;
use App\Offer;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    protected $guarded=[];
    protected $casts = [
      'lat' => 'float',  
      'long' => 'float',  
      "opening_hours" => "json",
    ];

    public function provider()
    {

        return $this->belongsTo(Provider::class ,'provider_id');
    }

    public function cashier()
    {
        return $this->hasMany(BranchStaff::class ,'branch_id')->where('type',UsersType::Cashier);
    }

    public function delivery()
    {
        return $this->hasMany(BranchStaff::class ,'branch_id')->where('type',UsersType::Delivery);
    }

    public function Product()
    {
        return $this->hasMany(BranchProduct::class,'branch_id');
    }

    public function offer()
    {
        return $this->hasOne(Offer::class ,'branch_id');
    }
}
