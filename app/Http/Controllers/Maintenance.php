<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class Maintenance extends Controller
{

    public function deploy(){

    	$commands = ['echo test','echo test2','ls'];

    	$output = [];

    	foreach($commands as $command){
    		array_push($output, shell_exec($command) );
    	}

    	var_dump($output);

    }
}
