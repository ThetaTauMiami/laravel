<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

class Maintenance extends Controller
{

    public function deploy(){

        $process = new Process('ls -lsa');
        $process->setTimeout(30);
        $process->run();

        $process2 = new Process('cd ../');
        $process2->setTimeout(30);
        $process2->run();

        $process3 = new Process('ls');
        $process3->setTimeout(30);
        $process3->run();

        // executes after the command finishes
        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }

        echo $process->getOutput();
        echo $process2->getOutput();
        echo $process3->getOutput();

    }
}
