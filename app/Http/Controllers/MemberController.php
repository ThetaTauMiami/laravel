<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use DB;

class MemberController extends Controller
{
    //

    public function profile($profile_id){
      $member = DB::table('users')
      ->where('id', $profile_id)
      ->first();
      return view('pages.profile', compact('member'));
    }
}
