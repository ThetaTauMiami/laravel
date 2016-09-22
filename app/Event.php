<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Event extends Model
{
    //This sets up the relationship between events and the users that own them
    public function users()
    {
      return $this->belongsTo('App\User');
    }

    public function images()
    {
      return $this->hasOne('App\Image');
    }

    public function albums(){
      return $this->hasOne('App\Album');
    }

    public function attendance(){
      return $this->hasOne('App\Attendance');
    }

    public $timestamps = false;
}
