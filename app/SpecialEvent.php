<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SpecialEvent extends Model
{
    public function attendees() {
    	return $this->hasMany('App\Attendee');
    }

    // really REALLY cool feature of laravel to auto convert data type to db string
    protected $casts = [
    	'fields' => 'array'
    ];

    // all fields fillable
    protected $guarded = [];
}
