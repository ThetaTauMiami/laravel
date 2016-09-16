<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\User;
use App\Album;
use Illuminate\Http\Request;
//use App\Http\Controllers\Auth;
use Auth;
use DB;
use Carbon\Carbon;

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
    public function index(Request $request)
    {
        // check if someone is logged in, if so send user to view
        if($request->user()){
            return view('pages.home',['user'=>$request->user()]);
        }else{
            return view('pages.home');
        }
    }



    public function gallery() {
        $albums = Album::with('images')->get();
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
