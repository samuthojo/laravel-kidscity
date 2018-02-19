<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Admin extends Authenticatable
{
    use Notifiable, SoftDeletes;

    protected $guard = 'admin';

    protected $fillable = [
        'name', 'email', 'phone_number', 'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];
}
