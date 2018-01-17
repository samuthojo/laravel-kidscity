<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DeliveryLocation extends Model
{
    use SoftDeletes;

    protected $fillable = [
      'location', 'delivery_price',
    ];

    public function orders()
    {
      return $this->hasMany('App\Order');
    }
}
