<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\User;
use DB;

class ProfileController extends Controller
{
    //
    function editMyProfile(){
      $profile_id = Auth::id();
      return editProfile($profile_id);
    }

    function editProfile($profile_id){
      $member = DB::table('users')
      ->where('id', $profile_id)
      ->first();
      return view('pages.editProfile', compact('member'));
    }

    public function update(Request $request, User $user){
      $user->update($request->all());

      return back();
    }
}
