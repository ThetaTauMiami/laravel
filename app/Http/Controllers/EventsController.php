<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Event;
use DB;

class EventsController extends Controller
{
    public function index()
    {
      $events = DB::table('events')->get();
      return view('pages.events', compact('events'));
    }


    protected function store(Request $request)
    {
        $this->validate($request, [
            'eventName' => 'required|unique:events,eventName',
            'pointType' => 'required',
            'points' => 'required|digits_between:1,2',
            'user_id' => 'required'
        ]);

        $event = new Event;
        $event->eventName = $request->eventName;
        $event->pointType = $request->pointType;
        $event->points = $request->points;
        $event->user_id = $request->user_id;
        $event->save();

        return \Redirect::to('/events');
    }
}
