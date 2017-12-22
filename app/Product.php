<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
  use SoftDeletes;

  protected $fillable = [
    'name', 'price', 'description', 'image_url',
    'gender', 'brand_id', 'category_id',
    'price_category_id', 'product_age_range_id',
  ];

  public function category()
  {
    return $this->belongsTo('App\Category');
  }

  public function brand()
  {
    return $this->belongsTo('App\Brand');
  }

  public function priceCategory()
  {
    return $this->belongsTo('App\PriceCategory');
  }

  public function productAgeRange()
  {
    return $this->belongsTo('App\ProductAgeRange');
  }

}
