<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Event extends Model
{
    //This sets up the relationship between events and the users that own them
    public function user()
    {
      return $this->belongsTo('App\User');
    }

    public function images()
    {
      return $this->hasMany('App\Image');
    }

    public $timestamps = false;
}
