<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductAgeRange extends Model
{
    use SoftDeletes;

    protected $fillable = [
      'range',
    ];

    public function products()
    {
      return $this->hasMany('App\Product');
    }
}
