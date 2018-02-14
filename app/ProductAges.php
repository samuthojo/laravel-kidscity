<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Iatstuti\Database\Support\CascadeSoftDeletes;

class ProductAges extends Model
{
  use SoftDeletes, CascadeSoftDeletes;

  protected $fillable = [
    'product_id', 'product_age_range_id',
  ];

  public function productAgeRange()
  {
    return $this->belongsTo('App\ProductAgeRange');
  }

  public function product()
  {
    return $this->belongsTo('App\Product');
  }
}
