<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class Maintenance extends Controller
{

    public function deploy(){

    	echo 'testing deploy';

    	$env = app()->environment();

    	$commands = [
    		'git pull origin '.$env,
    		'git checkout '.$env,
    		'php artisan config:cache',
    		'php artisan migrate'
    	];

    	echo 'commands made';

    	$output = [];
    	echo 'before execution';
    	foreach($commands as $command){
    		echo 'about to execute '.$command;
    		array_push($output, shell_exec($command) );
    	}

    	var_dump($output);

    }
}
