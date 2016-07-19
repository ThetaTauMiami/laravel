<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use DB;

class MembersController extends Controller
{
    //
    public function actives()
    {
      $actives = DB::table('users')
        ->select('RankNumber', 'name', 'email', 'ChapterClass', 'SchoolClass')
        ->where('ActiveStatus', 1)
        ->orderby('RankNumber');

      return view('pages.members', ['actives' => $actives]);
    }
}
