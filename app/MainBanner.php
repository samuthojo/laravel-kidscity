<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MainBanner extends Model
{
    use SoftDeletes;

    protected $fillable = ['image_url',];

}
