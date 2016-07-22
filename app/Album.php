<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
  public function users()
  {
    return $this->belongsTo('App\User');
  }

  public function images()
  {
    return $this->hasMany('App\Image');
  }

  public function events(){
    return this->belongsTo('App\Event');
  }

  public function semesters(){
    return this->belongsTo('App\Semester');
  }
}
