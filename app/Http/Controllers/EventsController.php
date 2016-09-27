<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Event;
use DB;
use Auth;
use App\Image;
use App\Attendance;
use Illuminate\Support\Facades\Redirect;
use Intervention\Image\ImageManagerStatic as Imager;
use Carbon\Carbon;
use File;

class EventsController extends Controller
{

  /* Require any user attempting to use event functions
   * to be logged in
   */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('roles:exec,admin,chair');
    }

    /*

      This function routes to the create Event page

    */
    function createEvent() {
      return view('events.createEvent');
    }

    function deleteEvent(Event $event){
      File::delete($event->image_id);
      DB::table('attendance')
      ->where('event_id', '=', $event->id)
      ->delete();
      DB::table('events')
      ->where('id', '=', $event->id)
      ->delete();

      return \Redirect::to('/events');
    }

    public function editEvent($id) {

      $event = DB::table('events')
      ->where('id', '=', $id)
      ->first();

      $image = DB::table('images')
      ->where('id', '=', $event->image_id)
      ->first();

      $album = DB::table('albums')
      ->where('event_id', '=', $id)
      ->first();

      return view('events.editEvent', compact('event', 'image', 'album'));

    }

    public function takeAttendanceVariable(Event $event) {
      $attendance = DB::table('attendance')
      ->where('event_id', '=', $event->id)
      ->get();

      $ids = NULL;
      foreach($attendance as $att){
        $ids[] = $att->user_id;
      }
      if($ids != NULL){
        $attended = DB::table('users')
        ->whereIn('id', $ids)
        ->where('active_status', '=', 1)
        ->orderBy('roll_number')
        ->get();
      }
      return view('events.takeAttendanceVariable', compact('event', 'attended', 'attendance'));
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
        ->where('active_status', '=', 1)
        ->orderBy('roll_number')
        ->get();

        $didNotAttend = DB::table('users')
        ->whereNotIn('id', $ids)
        ->where('active_status', '=', 1)
        ->orderBy('roll_number')
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
    public function saveAttendance(Request $request, Event $event){
      $attended = $request->attended;
      $didNotAttend = $request->didNotAttend;
      if($request->mobile == 1){
        $didNotAttend = DB::table('users')->whereNotIn('id', $attended)->get();
      }
      $eventAtt = DB::table('attendance')->where('event_id', '=', $event->id)->pluck('user_id');

      if($attended != NULL){
        foreach($attended as $a){
          if(!in_array($a, $eventAtt)){
            //DB::table('attendance')->insert(['user_id' => $a, 'event_id' => $event->id, 'points' => $event->points]);
            $attend = new Attendance;
            $attend->user_id = $a;
            $attend->event_id = $event->id;
            if(!$event->variable_points){
              $attend->points = $event->points;
            }
            else{
              $attend->points = 1;
            }
            $attend->save();
          }
        }
      }

      if($didNotAttend != NULL){
        foreach($didNotAttend as $b){
          if(in_array($b, $eventAtt)){
            DB::table('attendance')
            ->where([['event_id', '=', $event->id],['user_id', '=', $b]])
            ->delete();
          }
        }
      }

      if($event->variable_points && $attended != NULL){
        return \Redirect::to('/events/'.$event->id.'/attendance/variable');
      }
      else{
        return \Redirect::to('/events/'.$event->id);
      }
    }

    /*
      This function saves variable attendance points for events
    */
    public function saveVariableAttendance(Request $request, Event $event){
        $attendance = Attendance::where('event_id', '=', $event->id)->get();

        foreach($attendance as $a){
          $uid = $a->user_id;

          DB::table('attendance')
          ->where([['event_id', '=', $a->event_id],['user_id', '=', $a->user_id]])
          ->update(array('points' => $request->$uid));
        }

        return \Redirect::to('/events/'.$event->id);

    }


    /*
      This function creates a new Event in the database after validating them
    */
    protected function store(Request $request)
    {

      $this->validate($request, [
          'eventName' => 'required|unique:events,name',
          'pointType' => 'required',
          'points' => 'required|between:0,4',
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
          $im = Imager::make($filePath)->fit(300, 300)->save($filePath);

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
        if($request->is_public == "Public"){
           $event->is_public = true;
        }
        else{
          $event->is_public = false;
        }
        if($request->variable_points == "Var"){
           $event->variable_points = true;
        }
        else{
          $event->variable_points = false;
        }

        //ADDING SEMESTER_ID
        $today = Carbon::today()->toDateString();
        $semester = DB::table('semesters')
          ->whereDate('date_start', '<=', $today)
          ->whereNull('date_end')
          ->first();
        if(!$semester){
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

        //making the photo album that is tied into the event
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

    //this function updates events when you edit them
    public function update(Request $request, Event $event){
      $this->validate($request, [
          'eventName' => 'required|unique:events,name',
          'pointType' => 'required',
          'points' => 'required|between:0,4',
          'date' => 'required',
          'image' => 'image',
        ]);



      $event->name = $request->eventName;
      $event->type_id = $request->pointType;

      $event->points = $request->points;
      $event->user_id = Auth::user()->id;
      $event->date_time = $request->date;
      $event->description = $request->description;
      $event->location = $request->location;

      if($request->is_public == "Public"){
        $event->is_public = true;
      }
      else{
        $event->is_public = false;
      }

      if($request->variable_points == "Var"){

         $event->variable_points = true;
      }
      else{
        $event->variable_points = false;
      }

      $image = DB::table('images')
      ->where('id', '=', $event->image_id)
      ->first();

      //saving an image thumbnail
      if($request->image){
        if($image){
          //delete the old image
          unlink($image->file_path);
          DB::table('images')
          ->where('id', '=', $event->image_id)
          ->delete();
        }
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

      $event->save();

      $album = DB::table('albums')
      ->where('event_id', '=', $event->id)
      ->first();

      if($request->album == "Album"){
        if(!$album){
          $arguments = new Request;
          $arguments['name'] = $request->eventName;
          $arguments['description'] = $request->description;
          $arguments['location'] = $request->location;
          $arguments['event_id'] = $event->id;

          app('App\Http\Controllers\GalleryController')->storeAlbum($arguments);
        }

      }
      else{
        if($album){
          DB::table('albums')
          ->where('event_id', '=', $id)
          ->delete();
        }
      }

      return \Redirect::to("/events/".$event->id);
    }

}
