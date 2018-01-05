<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubCategory extends Model
{
    use SoftDeletes;

    protected $fillable = [
      'category_id', 'name',
    ];

    public function category()
    {
      return $this->belongsTo('App\Category');
    }

    public function products()
    {
      return $this->hasMany('App\Product');
    }
}
