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
        'first_name','last_name', 'email', 'password','phone','image_id','resume_path','chapter_class','roll_number','school_class'
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

    public function album()
    {
      return $this->hasMany('App\Album');
    }

    public function role()
    {
      return $this->hasOne('App\Role');
    }
}
