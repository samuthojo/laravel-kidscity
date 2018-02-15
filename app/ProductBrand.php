<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductBrand extends Pivot
{
    use SoftDeletes;

    protected $table = 'product_brands';

    // protected $touches = ['brand', 'product'];

    protected $fillable = ['product_id', 'brand_id'];

    public function product()
    {
        return $this->belongsTo('App\Product');
    }

    public function brand()
    {
        return $this->belongsTo('App\Brand');
    }
}
