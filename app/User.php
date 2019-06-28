<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'phone', 'verificaton_code', 'status', 'email', 'password',
    ];

    // protected $guarded = ['_token'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $with = ['profile_picture','home_address', 'courier_address'];


    public function profile_picture()
    {
        return $this->hasOne(Picture::class, 'user_id', 'id');
    }

    public function home_address()
    {
        return $this->hasOne(HomeAddress::class, 'user_id', 'id');
    }

    public function courier_address()
    {
        return $this->hasOne(CourierAddress::class, 'user_id', 'id');
    }
}
