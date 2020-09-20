<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{

    use SoftDeletes;

    protected $table = "user";

    protected $fillable = [
        'full_name', 'email', 'password','activation_code','is_active'
    ];

    protected $hidden = [
        'password', 'activation_code',
    ];
}
