<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

class Maintenance extends Controller
{

    public function deploy(){

        $process = new Process('cd ../;echo done;ls;cd ../;echo done2;ls;');
        $process->setTimeout(30);
        $process->run();

        // executes after the command finishes
        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }

        echo $process->getOutput();

    }
}
