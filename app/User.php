<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function committee()
    {
      return $this->hasOne('App\Committee');
    }

    public function images()
    {
      return $this->hasMany('App\Image');
    }

    public function events()
    {
      return $this->hasMany('App\Event');
    }
}
