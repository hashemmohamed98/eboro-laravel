<?php

namespace App;

use App\Models\Branch;
use App\Models\BranchProduct;
use App\Models\Order;
use App\Models\Provider;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Ordermultipleprovider extends Model
{
    protected $guarded=[];

    public function branch()
    {
        return $this->belongsTo(Branch::class ,'branch_id');
    }
    public function order()
    {
        return $this->belongsTo(Order::class,'order_id');
    }
    public function delivery()
    {
        return $this->belongsTo(User::class,'delivery_id');
    }
    public function cashier()
    {
        return $this->belongsTo(User::class,'cashier_id');
    }
}
