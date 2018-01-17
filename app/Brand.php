<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Brand extends Model
{
    use SoftDeletes;

    protected $fillable = [
      'name', 'description', 'image_url',
    ];

    public function products()
    {
      return $this->hasMany('App\Product');
    }
}
