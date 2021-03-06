<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{

	public $timestamps = false;

    //
    public function user()
    {
      return $this->hasOne('App\User');
    }

    public function semester()
    {
      return $this->hasOne('App\Semester');
    }
}
