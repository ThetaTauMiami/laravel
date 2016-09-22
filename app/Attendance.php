<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
  protected $table = 'attendance';

  public function event(){
    return $this->belongsTo('App\Event');
  }

  public function user(){
    return $this->belongsTo('App\User');
  }
}
