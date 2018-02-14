<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductPriceCategories extends Pivot
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
