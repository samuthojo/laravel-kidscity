<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Advert extends Model
{
    use SoftDeletes;
    use BannerProps;

    protected $fillable = ['image_url', 'link'];
}
