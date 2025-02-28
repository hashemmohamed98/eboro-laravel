<?php

namespace App;

use App\Models\BranchProduct;
use App\Models\Order;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Chatonline extends Model
{
    protected $guarded=[];

    public function Order()
    {
        return $this->belongsTo(Order::class ,'order_id');
    }

    public function User()
    {
        return $this->belongsTo(User::class ,'user_id');
    }
}
