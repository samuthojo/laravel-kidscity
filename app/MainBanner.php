<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MainBanner extends Model
{
    use SoftDeletes;
    use BannerProps;

    protected $fillable = ['image_url',];
}
