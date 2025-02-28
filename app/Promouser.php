<?php

namespace App;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Promouser extends Model
{
    protected $guarded=[];

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
    public function promo()
    {
        return $this->belongsTo(Promocode::class,'promo_id');
    }
}
