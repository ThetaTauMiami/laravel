<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class RecruitmentEvent extends Model
{
  public function images()
  {
    return $this->hasOne('App\Image');
  }
  public function image()
  {
    return $this->belongsTo('App\Image');
  }
  //return $this->hasOne();
}
