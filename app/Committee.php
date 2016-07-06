<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Committee extends Model
{
    //We dun goofed when making new migrations and forgot to 'snake case' the table name
    protected $table = 'committee';

    public function members()
    {
      return $this->hasMany('App\User');
    }
}
