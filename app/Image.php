<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{

    public function user()
    {
      return $this->hasOne('App\User');
    }

    public function events()
    {
      return $this->belongsTo('App\Event');
    }


    public function album()
    {
      return $this->belongsTo('App\Album');
    }
}
