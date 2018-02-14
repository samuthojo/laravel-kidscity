<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductCategories extends Model
{
  use SoftDeletes;

  protected $fillable = [
    'product_id', 'category_id',
  ];

  public function category()
  {
    return $this->belongsTo('App\Category');
  }

  public function product()
  {
    return $this->belongsTo('App\Product');
  }
  
}
