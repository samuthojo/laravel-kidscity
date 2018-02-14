<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductBrand extends Model
{
    use SoftDeletes;

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
