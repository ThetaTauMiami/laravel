<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bid extends Model
{
    protected $primaryKey = 'token';

    public $timestamps = false;
}
