<?php

namespace App;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Promocode extends Model
{
    protected $guarded=[];

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
    public function promo()
    {
        return $this->hasMany(Promouser::class,'promo_id');
    }
}
