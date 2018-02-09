<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductSize extends Model
{
    use SoftDeletes;

    protected $fillable = [
      'category_id', 'size',
    ];

    public function category()
    {
      return $this->belongsTo('App\Category');
    }

    public function products()
    {
      return $this->hasMany('App\ProductHasSize');
    }

    public function sizes()
    {
      return $this->hasMany('App\ProductHasSize');
    }
}
