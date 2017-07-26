<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Attendee;
use App\Pnm;
use App\SpecialEvent;

use Auth;
use DB;
use Carbon\Carbon;
use Mail;

class ChairController extends Controller
{

  public function __construct()
  {
      $this->middleware('auth');
      $this->middleware('roles:exec,admin,chair');
  }

  function showPanel(){
    return view('admin.panel_chair');
  }


  public function recruitmentList() {
      $pnms = DB::table('pnms')->get();
      return view('pages.recruitmentList', compact('pnms'));
  }

  public function recruitmentListDelete(Request $request) {

      if ($request->_delete == true) {
        Pnm::truncate();
      }
      return redirect('/recruitment/list');
  }

  function newSpecialEventForm(){

      return view('admin.specialevent_new');
  }

  function newSpecialEventSubmit(Request $request){

      $this->validate($request, [
        'name' => 'required',
        'description' => 'required',
        'slug' => 'required|unique:special_events|regex:/^[0-9a-z\-]+$/u',
        'reg_open' => 'required|date',
        'reg_close' => 'required|date',
      ], [
        'slug.regex' => 'URL Ending must consist of only numbers, lowercase letters, and dashes. For example: my-cool-event'
      ]);

      if (count($request->fields) !== count(array_unique($request->fields)) || in_array('', $request->fields)) {
        return \Redirect::back()->withErrors(['Registration fields must be unique and cannot be blank.'])->withInput($request->all());
      }

      $event = new SpecialEvent();

      $event->fill($request->all());

      $event->save();

      return redirect('/event/'.$request->slug);
  }

  function editSpecialEventSubmit(Request $request, $id){

      $this->validate($request, [
        'name' => 'required',
        'description' => 'required',
        'slug' => 'required|unique:special_events,slug,'.$id.'|regex:/^[0-9a-z\-]+$/u',
        'reg_open' => 'required|date',
        'reg_close' => 'required|date',
      ], [
        'slug.regex' => 'URL Ending must consist of only numbers, lowercase letters, and dashes. For example: my-cool-event',
        'slug.unique' => 'That URL Ending has already been taken by another existing event.'
      ]);

      $event = SpecialEvent::find($id);

      $event->fill($request->all());

      if ($request->fields == null) $event->fields = null;

      $event->save();

      return redirect('/event/'.$request->slug);
  }

  function editSpecialEventForm($id){
      $event = SpecialEvent::find($id);

      return view('admin.specialevent_edit', compact('event', 'id'));
  }

  function listSpecialEvents() {
      $events = SpecialEvent::orderBy('reg_open', 'desc')->get();

      return view('admin.specialevent_list', compact('events'));
  }


  function specialEventDownload($id) {
    $event = SpecialEvent::findOrFail($id);

    $ppl = $event->attendees()->get();

    $keys = [];

    foreach($ppl as $person) {
      $keys = array_merge($keys, array_keys(($person->responses != null) ? $person->responses : []));
    }
    $keys = array_unique($keys);


    $filename = $event->slug."_responses.csv";
    $handle = fopen($filename, 'w+');
    fputcsv($handle, array_merge(['Name','Email'],$keys,['Comments/Notes']));

    foreach($ppl as $person) {
        $row = [$person['name'], $person['email']];
        foreach($keys as $key) {
          $item = '';
          if (isset($person->responses[$key])) {
            $item = $person->responses[$key];
          }
          array_push($row,$item);
        }
        array_push($row, $person['comments']);
        fputcsv($handle, $row);
    }

    fclose($handle);

    $headers = array(
        'Content-Type' => 'text/csv',
    );

    return \Response::download($filename, $filename, $headers);

  }


}
