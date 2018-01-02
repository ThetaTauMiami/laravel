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


    // really REALLY cool feature of laravel to auto convert data type to db string
    protected $casts = [
      'companies' => 'array'
    ];


    // protected $fillable = [
    //     'first_name','last_name', 'email', 'password','phone','image_id','resume_path','chapter_class','roll_number','school_class','major','minor'
    // ];

    protected $guarded = [];


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

    public function image()
    {
      return $this->belongsTo('App\Image');
    }

    public function attendance(){
      return $this->hasMany('App\Attendance');
    }

    public function events()
    {
      return $this->hasMany('App\Event');
    }

    public function album()
    {
      return $this->hasMany('App\Album');
    }

    public function roles()
    {
      return $this->belongsToMany('App\Role');
    }
}
