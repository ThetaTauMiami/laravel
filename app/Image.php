<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    //We dun goofed again
    protected $table = 'image';

    public function poster()
    {
      return $this->hasOne('App\User');
    }
}
