<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{

    use SoftDeletes;

    protected $table = "user";

    protected $fillable = ['full_name', 'email', 'password','activation_code','is_active', 'is_admin'];
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
    const DELETED_AT = 'deleted_at';
    protected $hidden = ['password', 'activation_code'];

    public function user_detail()
    {
        return $this->hasOne('App\Models\UserDetail')->withDefault();
    }
}
