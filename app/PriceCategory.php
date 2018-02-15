<?php

namespace App;

use Iatstuti\Database\Support\CascadeSoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PriceCategory extends Model
{
  use SoftDeletes, CascadeSoftDeletes;

  // protected $cascadeDeletes = ['products'];

  protected $fillable = ['range',];

  public function products()
  {
    return $this->belongsToMany('App\Product', 'product_price_categories')
                ->withTimestamps()
                ->using('App\ProductPriceCategories');
  }
}
