<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    //We dun goofed again
    protected $table = 'images';

    public function user()
    {
      return $this->hasOne('App\User');
    }

    public function events()
    {
      return $this->belongsTo('App\Event');
    }

    public function events()
    {
      return $this->belongsTo('App\Album');
    }
}
