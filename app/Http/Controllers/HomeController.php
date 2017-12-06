<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\User;
use App\Album;
use App\SpecialEvent;
use App\Attendee;
use App\Pnm;
use App\RecruitmentEvent;
use Illuminate\Http\Request;
//use App\Http\Controllers\Auth;
use Auth;
use DB;
use Carbon\Carbon;
use Mail;
use App\Image;
use Intervention\Image\ImageManagerStatic as Imager;

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

    public function recruitment(){
      $complete = ['value' => 0];
      //$recruitment_events = DB::table('recruitment_events')->get();
      $recruitment_events = RecruitmentEvent::with("image")->get();
      //die(var_dump($recruitment_events));
      return view('pages.recruitment',compact('recruitment_events'))->with('complete',$complete);
    }

    public function createRecruitmentEvent(){
        return view('pages.createRecruitment');
    }

    //Stores the new recruitment event in the database
    protected function store(Request $request){
      $this->validate($request, [
          'title' => 'required',
          'description' => 'required'
        ]);
      $recruitment_event = new RecruitmentEvent;

      //RecruitmentEvent
      if($request->image){
        $img = $request->file('image');
        $extension = $img->getClientOriginalExtension();
        $fileName = $img->getClientOriginalName();//EventsController::generateRandomString();//$img->getClientOriginalName();
        $publicPath = public_path();
        $filePath = "uploads/RecruitmentEvent_Thumbs/{$fileName}";
        $request['filepath'] = $filePath;


        $img->move("uploads/RecruitmentEvent_Thumbs", $fileName);
        //$im = Imager::make($filePath)->fit(350, 350)->save($filePath);
          $im = Imager::make($filePath)->save($filePath);
        $image = new Image;

        $image->description = $request->description;
        $image->file_path = $filePath;
        $image->user_id = Auth::user()->id;
        $image->thumb_path = $filePath;
        $image->save();

        $recruitment_event->image_id = $image->id;
      }
      $recruitment_event->title = $request->title;
      $recruitment_event->description = $request->description;
      $recruitment_event->location = $request->location;
      //$recruitment_event->date_time = $request->date_time;
      $recruitment_event->when = $request->when;
      $recruitment_event->note = $request->note;
      $recruitment_event->save();
      //   $event = new Event;
      return redirect('recruitment');
    }



    public function editRecruitmentEvent($id){
      $recruitment_event = DB::table('recruitment_events')
      ->where("id", "=", $id)
      ->first();
      return view('pages.editRecruitment' , compact('recruitment_event'));
    }

    //Saves the changes to the RecruitmentEvent
    public function update(Request $request,  $id){

      $this->validate($request,[
        'title' => 'required',
        'description' => 'required'
      ]);
      $recruitment_event1 = new RecruitmentEvent;
      $recruitment_event1 = \App\RecruitmentEvent::where("id", "=", $id)->first();
      //die(var_dump($recruitment_event1));
      if($request->image){
        $img = $request->file('image');
        $extension = $img->getClientOriginalExtension();
        $fileName = $img->getClientOriginalName();//EventsController::generateRandomString();//$img->getClientOriginalName();
        $publicPath = public_path();
        $filePath = "uploads/RecruitmentEvent_Thumbs/{$fileName}";
        $request['filepath'] = $filePath;


        $img->move("uploads/RecruitmentEvent_Thumbs", $fileName);
        //$im = Imager::make($filePath)->fit(350, 350)->save($filePath);
          $im = Imager::make($filePath)->save($filePath);
        $image = new Image;

        $image->description = $request->description;
        $image->file_path = $filePath;
        $image->user_id = Auth::user()->id;
        $image->thumb_path = $filePath;
        $image->save();

        $recruitment_event1->image_id = $image->id;
      }

      $recruitment_event1->title = $request->title;
      $recruitment_event1->description = $request->description;
      $recruitment_event1->location = $request->location;
      //$recruitment_event1->date_time = $request->date_time;
      $recruitment_event1->when = $recruitment_event1->when;
      $recruitment_event1->note = $request->note;
      $recruitment_event1->save();
      return redirect('recruitment');
    }

    public function deleteRecruitmentEvent($id){
      //File::delete($recruitment_event->image_id);
      DB::table('recruitment_events')
      ->where("id", "=", $id)
      ->delete();
      return redirect('recruitment');
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
