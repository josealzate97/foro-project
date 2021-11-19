<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    CONST STATUS_ACTIVE = 1;
    CONST STATUS_INACTIVE = 2;
    CONST ROLE_ADMIN = 1;
    CONST ROLE_USER = 2;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
    */
    protected $fillable = [
        'id',
        'name',
        'lastname',
        'email',
        'username',
        'password',
        'rol',
        'status'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
    */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
    */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
