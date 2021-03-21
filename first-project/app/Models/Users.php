<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Users extends Authenticatable
{
    use SoftDeletes;
    protected $table = 'users';

    protected $fillable = ['full_name', 'email', 'password', 'activation_key', 'isActive'];

    protected $hidden = ['password', 'activation_key',];
}
