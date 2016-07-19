<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use DB;

class AlumniController extends Controller
{
    //
    public function alumni()
    {
      $alumni = DB::table('users')
        ->select('RankNumber', 'name', 'email', 'ChapterClass', 'SchoolClass')
        ->where('ActiveStatus', 0)
        ->orderby('RankNumber');

      return view('pages.alumni', ['alumni' => $alumni]);
    }
}
