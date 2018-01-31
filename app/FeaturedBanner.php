<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FeaturedBanner extends Model
{
    use SoftDeletes;

    protected $fillable = ['name', 'image_url',];

}
