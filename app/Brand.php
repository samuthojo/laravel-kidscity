<?php

namespace App;

use Iatstuti\Database\Support\CascadeSoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Brand extends Model
{
    use SoftDeletes, CascadeSoftDeletes;

    // protected $cascadeDeletes = ['products'];

    protected $fillable = [
      'name', 'description', 'image_url',
    ];

    public function products()
    {
      return $this->belongsToMany('App\Product', 'product_brands')
                  ->using('App\ProductBrand');
    }
}
