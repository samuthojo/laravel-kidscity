<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use SoftDeletes;

    protected $fillable = [
      'user_id', 'delivery_location_id',
    ];

    public function orderItems()
    {
      return $this->hasMany('App\OrderItem');
    }

    public function user()
    {
      return $this->belongsTo('App\User');
    }

    public function deliveryLocation()
    {
      return $this->belongsTo('App\DeliveryLocation');
    }
}
