<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\User;
use App\Album;
use App\SpecialEvent;
use App\Attendee;
use App\Pnm;
use Illuminate\Http\Request;
//use App\Http\Controllers\Auth;
use Auth;
use DB;
use Carbon\Carbon;
use Mail;
use Response;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    /*
    public function __construct()
    {
        $this->middleware('auth');
    }
*/
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
*/

    public function phpinfo(){
      return phpinfo();
    }

    public function index(Request $request)
    {
        // check if someone is logged in, if so send user to view
        if($request->user()){
            return view('pages.home',['user'=>$request->user('')]);
        }else{
            return view('pages.home');
        }
    }

    function resume(User $user) {
      return Response::make(file_get_contents(public_path().$user->resume_path), 200, [
          'Content-Type' => 'application/pdf',
          'Content-Disposition' => 'inline; filename="'.$user->first_name.' '.$user->last_name.' [Miami University - Theta Tau] Resume.pdf"'
      ]);
    }

    function specialEventShow($slug){

      $event = SpecialEvent::where('slug', $slug)->first();

      if ($event == null) return redirect('/')->withErrors(['The event you tried to open does not exist or was removed. Check your spelling or please feel free to contact us with any questions.']);
      
      return view('pages.specialevent', compact('event'));

    }

    function specialEventStore($id, Request $request){

      $special_event = SpecialEvent::find($id);

      if ($special_event == null) return redirect('/')->withErrors(['The event you tried to open does not exist or was removed. Check your spelling or please feel free to contact us with any questions.']);

      $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
          ]);

      $responses = [];

      foreach ($request->all() as $key => $value){
        if(!in_array($key, ['name', 'email', 'comments', '_token'])) {
          $responses[str_replace('_',' ',$key)] = $value;
        }
      }

      $new = new Attendee();
      $new->special_event_id = $special_event->id;
      $new->name = $request->name;
      $new->email = $request->email;
      $new->responses = $responses;
      $new->comments = $request->comments;
      $new->save();



      return redirect(url('/event/'.$special_event->slug))->with('status', 'You have successfully been registered for this event!');
    }



    public function gallery() {
        $albums = Album::with('images')->orderBy('created_at', 'desc')->get();
        return view('pages.gallery', compact('albums'));
    }

    public function events() {
      $semester = HomeController::getCurrentSemester();
      $events = DB::table('events')
      ->where('semester_id', '=', $semester->id)
      ->orderBy('date_time', 'asc')
      ->get();
      return view('pages.events', compact('events'));
    }

    public function recruitment() {
      $complete = ['value' => 0];
      return view('pages.recruitment')->with('complete', $complete);
    }


    public function recruitmentSignUp() {

      return view('pages.recruitmentSignUp');
    }

    public function recruitmentSubmit(Request $request)
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


    public function profile(User $user){
      $image = DB::table('images')
        ->where('id', $user->image_id)
        ->first();



      return view('pages.profile', compact('user', 'image'));
    }

    public function members() {
      $members= User::with('image')
        ->where('active_status', 1)
        ->orderby('roll_number')
        ->get();

        return view('pages.members', compact('members'));
    }

    public function alumni() {
      $alumni = User::where('active_status', 0)
        ->with ('image')
        ->orderby('roll_number')
        ->get();

        return view('pages.alumni', compact('alumni'));
    }

    public function contact() {
        return view('pages.contact');
    }

    public function welcome() {
      return view('auth.welcome');
    }

    public function contactSubmit(Request $request){

        $this->validate($request, [
          'email' =>    'required|email',
          'subject' =>  'required',
          'message_body' =>  'required',
          'name' =>     'required'
        ]);

        Mail::send('emails.contact-confirmation', ["name"=>$request->name], function ($message) use ($request) {
          $message->from('noreply@thetataumiami.com', 'Theta Tau Miami');
                $message->subject('Contact Form Confirmation');

          $message->to($request->email);
        });

        Mail::send('emails.contact', ["name"=>$request->name,"email"=>$request->email,"subject"=>$request->subject,"message_body"=>$request->message_body], function ($message) use ($request) {
          $message->from($request->email, $request->name);
                $message->subject('Contact Form: '.$request->subject);

          $message->to('thetatau@miamioh.edu');  // HARD CODED EXEC EMAIL ADDRESS, NOT SURE WHERE ELSE WE'D PUT THIS
        });

        return view ('pages.contact',['formSuccess'=>1]);
    }

    public function retrieveIndividualEvent($id)
    {
      $event = DB::table('events')
        ->where('id', '=', $id)
        ->first();

      $image = DB::table('images')
        ->where('id', '=', $event->image_id)
        ->first();

      $album = DB::table('albums')
        ->where('event_id', '=', $id)
        ->first();


      return view("events.individualEvent", compact('event', 'image', 'album'));
    }

    public function retrieveImagesByAlbum(\App\Album $album)
    {
      $images = DB::table('images')
        ->where('album_id', '=', $album->id)
        ->get();

      $album = DB::table('albums')
        ->where('id', '=', $album->id)
        ->first();

      return view("gallery.albumGallery", compact('images'), compact('album'));
    }

    public function retrieveImagesByUploader($uploader)
    {
      $images = DB::table('images')
        ->where('user_id', '=', $uploader)
        ->get();
      return view('pages.gallery', compact('images'));
    }

    public function retrieveAllImages(){
      $images = DB::table('images')->get();
      return view('pages.gallery', compact('images'));
    }

    public function login() {
        return view('auth.login');
    }

    public function getCurrentSemester(){
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
      return $semester;
    }


}
