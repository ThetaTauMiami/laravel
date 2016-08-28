<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Pnm;

class RecruitmentController extends Controller
{
  protected function store(Request $request)
  {
      $this->validate($request, [
        'email' => 'required|unique:pnms,email',
        'first_name' => 'required',
        'last_name' => 'required'
      ]);

      $pnm = new Pnm;
      $pnm->email = $request->email;
      $pnm->first_name = $request->first_name;
      $pnm->last_name = $request->last_name;

      $pnm->save();

      return \Redirect::to('/recruitment');
  }
}
