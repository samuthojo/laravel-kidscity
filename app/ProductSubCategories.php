<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductSubCategories extends Pivot
{
  use SoftDeletes;

  protected $table = 'product_sub_categories';

  // protected $touches = ['subCategory', 'product'];

  protected $fillable = [
    'product_id', 'sub_category_id',
  ];

  public function subCategory()
  {
    return $this->belongsTo('App\SubCategory');
  }

  public function product()
  {
    return $this->belongsTo('App\Product');
  }
}
