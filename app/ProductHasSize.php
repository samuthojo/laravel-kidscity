<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductHasSize extends Model
{
    use SoftDeletes;

    protected $fillable = [
      'product_id', 'product_size_id',
    ];

    public function size()
    {
      return $this->belongsTo('App\ProductSize');
    }

    public function product()
    {
      return $this->belongsTo('App\Product');
    }
}
