<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attendee extends Model
{
    public function special_event() {
    	return $this->belongsTo('App\SpecialEvent');
    }

    protected $casts = [
    	'responses' => 'array'
    ];

    // all fields fillable
    protected $guarded = [];
}
