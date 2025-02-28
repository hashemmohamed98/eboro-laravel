<?php

namespace App;

use App\Models\Provider;
use Illuminate\Database\Eloquent\Model;

class ProviderType extends Model
{
    protected $guarded=[];
    public function provider()
    {
        return $this->belongsTo(Provider::class ,'provider_id');
    }
    public function type()
    {
        return $this->belongsTo(Type::class ,'type_id');
    }
}
