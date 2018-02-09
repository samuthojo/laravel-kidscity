<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductPicture extends Model
{
    use SoftDeletes;

    protected $fillable = [
      'product_id', 'image_url',
    ];

    public function product()
    {
      return $this->belongsTo('App\Product');
    }
}
