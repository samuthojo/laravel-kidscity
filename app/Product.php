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

}
