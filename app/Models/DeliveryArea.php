<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DeliveryArea extends Model
{
    protected $guarded=[];
    protected $table = 'delivery_area';

    protected $fillable = [
        'provider_id',
        'distance_from',
        'distance_to',
        'delivery_fee',
        'minimum_order_amount',
        'fulfillment_time_id',
    ];
    public function fulfillmentTimeRange()
    {
        return $this->belongsTo(FulfillmentTimeRange::class, 'fulfillment_time_id');
    }

    public function provider()
    {
        return $this->belongsTo(Provider::class);
    }
}
