<?php

namespace App\Models;

use App\Ordermultipleprovider;
use App\OrderRate;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $guarded=[];
    protected $casts = [
        'ordar_at' => 'datetime',

    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class,'branch_id');
    }

    public function delivery()
    {
        return $this->belongsTo(User::class,'delivery_id');
    }

    public function cashier()
    {
        return $this->belongsTo(BranchStaff::class,'cashier_id');
    }

    public function content()
    {
        return $this->hasMany(OrderProduct::class ,'order_id');
    }

    public function branches()
    {
        return $this->hasMany(Ordermultipleprovider::class ,'order_id');
    }

    public function log()
    {
        return $this->hasMany(OrderLog::class,'order_id');
    }

    public function rate()
    {
        return $this->hasMany(OrderRate::class,'order_id');
    }

}
