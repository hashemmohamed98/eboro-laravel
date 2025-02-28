<?php

namespace App\Models;

use App\Helper\UsersType;
use App\Payapal_order;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','house','intercom', 'email', 'email_verified_at' , 'password','remember_token','address','type','verify_code','mobile','image','active','lat','long','online',
        'company_name','city','country','postal_code','front_id_image','back_id_image','license_image','license_expire'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    public function generateAuthToken()
    {
        return \JWTAuth::fromUser($this);
    }

    public function cashierBranch()
    {
        return $this->hasOne(BranchStaff::class,'user_id')
            ->where('type',UsersType::Cashier);
    }

    public function deliveryBranch()
    {
        return $this->hasOne(BranchStaff::class,'user_id')
            ->where('type',UsersType::Delivery);
    }

    public function Branch()
    {
        return $this->hasOne(BranchStaff::class,'user_id');
    }

    public function provider()
    {
        return $this->hasOne(Provider::class,'user_id');
    }

    public function carts()
    {
        return $this->hasMany(Cart::class,'user_id');
    }

    public function Orders()
    {
        return $this->hasMany(Order::class,'user_id')->latest();
    }

    public function Favorite()
    {
        return $this->hasMany(Favorite::class,'user_id');
    }

    public function Rate()
    {
        return $this->hasMany(Rate::class,'user_id');
    }

    public function Paypal()
    {
        return $this->hasMany(Payapal_order::class,'user_id');
    }

    public function log()
    {
        return $this->hasMany(OrderLog::class,'delivery_id');
    }
}
