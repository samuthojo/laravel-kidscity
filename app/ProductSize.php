<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Iatstuti\Database\Support\CascadeSoftDeletes;

class ProductSize extends Model
{
    use SoftDeletes, CascadeSoftDeletes;

    protected $cascadeDeletes = ['products'];

    protected $fillable = [
      'size',
    ];

    public function products()
    {
      return $this->belongsToMany('App\Product', 'product_has_sizes')
                  ->using('App\ProductHasSize');
    }

}
