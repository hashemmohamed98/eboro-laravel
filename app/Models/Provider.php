<?php

namespace App\Models;

use App\Offer;
use App\ProviderType;
use App\ProviderTypeInner;
use App\Type;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Provider extends Model
{
    protected $guarded = [];
    protected $casts = [
        'position' => 'integer', // Assuming 'position' is an integer
        'delivery' => 'boolean', // Assuming 'position' is an integer
    ];
    public function user()
    {
        foreach (Branch::where(["provider_id" => $this->id])->get() as $bran){
            $today = Carbon::now();
            $open_days_array = explode(',', $bran->open_days);
            $open_time_array = explode(',', $bran->open_time);
            $close_time_array = explode(',', $bran->close_time);
            if (in_array($today->englishDayOfWeek, $open_days_array))
            {
                foreach (array_keys($open_days_array, $today->englishDayOfWeek) as $key)
                {
                    if($today->between(Carbon::parse($open_time_array[$key]), Carbon::parse($close_time_array[$key]), true))
                    {
                        $bran->status = 0; // open
                        $bran->save();
                        break;
                    }
                    else if($today->between(Carbon::parse($open_time_array[$key]), Carbon::parse($close_time_array[$key])->addDay(), true) && $open_time_array > $close_time_array)
                    {
                        $bran->status = 0; // open
                        $bran->save();
                    }
                    else
                    {
                        $bran->status = 1; // close
                        $bran->save();
                    }
                }
            }
            else
            {
                $bran->status = 1; // close
                $bran->save();
            }
        }
        return $this->belongsTo(User::class, 'user_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function branch()
    {
        foreach (Branch::where(["provider_id" => $this->id])->get() as $bran){
            $today = Carbon::now();
            $open_days_array = explode(',', $bran->open_days);
            $open_time_array = explode(',', $bran->open_time);
            $close_time_array = explode(',', $bran->close_time);
            if (in_array($today->englishDayOfWeek, $open_days_array))
            {
                foreach (array_keys($open_days_array, $today->englishDayOfWeek) as $key)
                {
                    if($today->between(Carbon::parse($open_time_array[$key]), Carbon::parse($close_time_array[$key]), true))
                    {
                        $bran->status = 0; // open
                        $bran->save();
                        break;
                    }
                    else if($today->between(Carbon::parse($open_time_array[$key]), Carbon::parse($close_time_array[$key])->addDay(), true) && $open_time_array > $close_time_array)
                    {
                        $bran->status = 0; // open
                        $bran->save();
                    }
                    else
                    {
                        $bran->status = 1; // close
                        $bran->save();
                    }
                }
            }
            else
            {
                $bran->status = 1; // close
                $bran->save();
            }
        }
        return $this->hasMany(Branch::class,'provider_id');
    }

    public function offer()
    {
        return $this->hasOne(Offer::class ,'provider_id');
    }

    public function I_offer()
    {
        $time = Carbon::now();
        $offers = $this->offer()->whereDate('start_at','<=', $time)
            ->whereDate('end_at','>=', $time)
            ->get();
        $max = 0;
        foreach ($offers as $offer)
        {
            if($offer->value > $max)
                $max = $offer->value;
        }

        return $max;
    }

    public function Rates()
    {
        return $this->hasMany(Rate::class,'provider_id');
    }

    public function typed()
    {
        return $this->hasMany(ProviderType::class,'provider_id');
    }

    public function typeInner()
    {
        return $this->hasMany(ProviderTypeInner::class,'provider_id');
    }
}
