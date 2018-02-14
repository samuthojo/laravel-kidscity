<?php

namespace App;

use Iatstuti\Database\Support\CascadeSoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
  use SoftDeletes, CascadeSoftDeletes;

  protected $cascadeDeletes = ['subCategories', 'products'];

  protected $fillable = ['name', 'image_url',];

  public function subCategories()
  {
    return $this->hasMany('App\SubCategory');
  }

  public function products()
  {
    return $this->belongsToMany('App\Product', 'product_categories')
                ->using('App\ProductCategories');
  }
}
