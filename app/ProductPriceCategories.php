<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductPriceCategories extends Model
{
    use SoftDeletes;

    protected $fillable = ['product_id', 'price_category_id'];

    public function product()
    {
      return $this->belongsTo('App\Product');
    }

    public function priceCategory()
    {
      return $this->belongsTo('App\PriceCategory');
    }
}
