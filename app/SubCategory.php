<?php

namespace App;

use Iatstuti\Database\Support\CascadeSoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubCategory extends Model
{
    use SoftDeletes, CascadeSoftDeletes;

    // protected $cascadeDeletes = ['products'];

    protected $fillable = [
      'category_id', 'name', 'image_url',
    ];

    public function category()
    {
      return $this->belongsTo('App\Category');
    }

    public function products()
    {
      return $this->belongsToMany('App\Product', 'product_sub_categories')
                  ->withTimestamps()
                  ->using('App\ProductSubCategories');
    }
}
