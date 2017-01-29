<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\tempregionals;
use App\Pnm;

class FormController extends Controller
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

      $complete = 1;
      return view('pages.recruitment')->with('complete', $complete);
  }


  function specialeventsSignup($id){

    // lololol fake id for now, any id points to the same event

    // eventually get a special event and pull its info for the form
    $complete = 0;
    return view('pages.specialevents', compact('complete'));

  }

  function specialeventsStore($id, Request $request){

    $this->validate($request, [
          'name' => 'required',
          'email' => 'required|email',
          'shirt' => 'required',
          'chapter' => 'required'
        ]);

    $new = new tempregionals($request->all());
    $new->save();// not sure if necessary but whatever

    $complete = 1;
    return view('pages.specialevents', compact('complete'));
  }


}
