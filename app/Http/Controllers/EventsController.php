<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Event;
use DB;
use Auth;
use App\Image;
use Illuminate\Support\Facades\Redirect;
use Intervention\Image\ImageManagerStatic as Imager;
use Carbon\Carbon;

class EventsController extends Controller
{

  /* Require any user attempting to event
   * to be logged in
   */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /*

      This function routes to the create Event page

    */
    public function createEvent() {

      return view('events.createEvent');

    }

    public function editEvent($id) {
      $event = DB::table('events')
      ->where('id', '=', $id)
      ->first();

      $image = DB::table('images')
      ->where('id', $event->image_id)
      ->get();

      return view('events.editEvent', compact('event', 'image'));

    }

    /*

      This function routes to the taking attendance page

    */
    public function takeAttendance($id) {

      $event = DB::table('events')
      ->where('id', '=', $id)
      ->first();

      $attendance = DB::table('attendance')
      ->where('event_id', '=', $id)
      ->get();

      $ids = NULL;
      foreach($attendance as $att){
        $ids[] = $att->user_id;
      }

      $attended = NULL;
      $didNotAttend = NULL;
      if($ids != NULL){
        $attended = DB::table('users')
        ->whereIn('id', $ids)
        ->get();

        $didNotAttend = DB::table('users')
        ->whereNotIn('id', $ids)
        ->get();
      }
      else{
        $didNotAttend = DB::table('users')->get();
      }



      return view('events.takeAttendance', compact('event', 'attended', 'didNotAttend'));

    }

    /*
      This function saves the attendance record for an event
    */
    public function saveAttendance(Request $request){
      $attended = $request->attended;
      $didNotAttend = $request->didNotAttend;
      $eId = $request->event;
      $eventAtt = DB::table('attendance')->where('event_id', '=', $eId)->pluck('user_id');

      if($attended != NULL){
        foreach($attended as $a){
          if(!in_array($a, $eventAtt)){
            DB::table('attendance')->insert(['user_id' => $a, 'event_id' => $eId]);
          }
        }
      }

      if($didNotAttend != NULL){
        foreach($didNotAttend as $b){
          if(in_array($b, $eventAtt)){
            DB::table('attendance')
            ->where([['event_id', '=', $eId],['user_id', '=', $b]])
            ->delete();
          }
        }
      }

      return \Redirect::to('/events/'.$eId);
    }

    /*
      This function creates a new Event in the database after validating them
    */
    protected function store(Request $request)
    {

      $this->validate($request, [
          'eventName' => 'required|unique:events,eventName',
          'pointType' => 'required',
          'points' => 'required|between:0,9',
          'date' => 'required',
          'image' => 'image',
        ]);

        $event = new Event;

        //creating the thumbnail

        if($request->image){
          $img = $request->file('image');
          $extension = $img->getClientOriginalExtension();
          $fileName = $img->getClientOriginalName();
          $publicPath = public_path();
          $filePath = "uploads/Event_Thumbs/{$fileName}";
          $request['filepath'] = $filePath;

          $this->validate($request, [
              'filepath' => 'unique:images,file_path'
          ]);

          $img->move("uploads/Event_Thumbs", $fileName);
          $im = Imager::make($filePath)->resize(150, 150)->save($filePath);

          $image = new Image;

          $image->description = $request->description;
          $image->file_path = $filePath;
          $image->user_id = Auth::user()->id;
          $image->thumb_path = $filePath;
          $image->save();

          $event->image_id = $image->id;
        }



        $event->name = $request->eventName;
        $event->type_id = $request->pointType;

        $event->points = $request->points;
        $event->user_id = Auth::user()->id;
        $event->date_time = $request->date;
        $event->description = $request->description;
        $event->location = $request->location;
        if($request->is_public = "Public"){
           $event->is_public = true;
        }
        else{
          $event->is_public = false;
        }

        //ADDING SEMESTER_ID
        $today = Carbon::today()->toDateString();
        $semester = DB::table('semesters')
          ->whereDate('date_start', '<=', $today)
          ->whereDate('date_end', '=', NULL)
          ->get();
        if($semester == NULL){
          $semester = DB::table('semesters')
            ->whereDate('date_start', '<=', $today)
            ->whereDate('date_end', '>', $today)
            ->first();
        }

        $event->semester_id = $semester->id;

        $request['semester'] = $event->semester_id;

        $this->validate($request, [
            'semester' => 'required'
        ]);

        $event->save();

        //making the photo album
        if($request->album == "Album") {
          $arguments = new Request;
          $arguments['name'] = $request->eventName;
          $arguments['description'] = $request->description;
          $arguments['location'] = $request->location;
          $arguments['event_id'] = $event->id;

          app('App\Http\Controllers\GalleryController')->storeAlbum($arguments);
        }

        return \Redirect::to('/events');
    }

    public function update(Request $request){

    }

}
