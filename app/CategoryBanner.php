<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CategoryBanner extends Model
{
    use SoftDeletes;
    use BannerProps;

    protected $fillable = ['name', 'image_url', 'link',];
}
