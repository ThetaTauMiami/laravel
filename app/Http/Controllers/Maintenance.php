<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class Maintenance extends Controller
{

    public function deploy(){

    	$commands = [
    		'git pull origin '.app()->envrionment(),
    		'git checkout '.app()->envrionment(),
    		'php artisan config:cache',
    		'php artisan migrate'
    	];

    	$output = [];

    	foreach($commands as $command){
    		array_push($output, shell_exec($command) );
    	}

    	var_dump($output);

    }
}
