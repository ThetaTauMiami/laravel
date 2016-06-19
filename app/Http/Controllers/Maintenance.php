<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class Maintenance extends Controller
{

    public function deploy(){

    	$commands = ['echo test','echo test2','ls'];

    	SSH::run($commands, function($line)
		{
		    echo $line.PHP_EOL;
		});

    }
}
