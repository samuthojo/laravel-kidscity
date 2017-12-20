<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductColor extends Model
{
    use SoftDeletes;

    protected $fillable = [
      'color', 'image_url', 'product_id',
    ];
}
