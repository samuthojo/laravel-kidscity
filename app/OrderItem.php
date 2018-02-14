<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderItem extends Model
{
    use SoftDeletes;

    protected $fillable = [
      'order_id', 'product_id', 'quantity',
    ];

    public function order()
    {
      return $this->belongsTo('App\Order');
    }

    public function product()
    {
      return $this->belongsTo('App\Product');
    }

    public function totalPrice()
    {
      return $this->product()->withTrashed()->first()->price * $this->quantity;
    }
}
