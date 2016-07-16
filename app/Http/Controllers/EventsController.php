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


    public function store(Request $request)
    {

        $event = new Event;
        $event->eventName = $request->eventName;
        $event->pointType = $request->pointType;
        $event->points = $request->points;
        $event->user_id = $request->user_id;
        $event->save();

        /*DB::table('events')->insertGetId(['eventName' => $request->eventName,
                                          'pointType' => $request->pointType,
                                          'points' => $request->points,
                                          'creator' => $request->creator]);*/

        return \Redirect::to('/events');
    }
}
