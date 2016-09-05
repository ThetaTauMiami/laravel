<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Semester extends Model
{

    public $timestamps = false;

    //
    public function albums()
    {
      return $this->hasMany('App\Album');
    }

    public function events()
    {
      return $this->hasMany('App\Event');
    }

    public function roles()
    {
      return $this->hasMany('App/Role');
    }
}
