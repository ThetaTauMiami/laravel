<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class Maintenance extends Controller
{

    public function deploy(){

        return view("maintenance.deploy");

    }
}
