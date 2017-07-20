<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SpecialEvent extends Model
{
    public function attendees() {
    	return $this->hasMany('App\Attendee');
    }
}
