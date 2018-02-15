<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\SoftDeletes;
use Iatstuti\Database\Support\CascadeSoftDeletes;

class ProductAges extends Pivot
{
  use SoftDeletes, CascadeSoftDeletes;

  protected $table = 'product_ages';

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
