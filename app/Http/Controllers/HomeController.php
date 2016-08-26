<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
//use App\Http\Controllers\Auth;
use Auth;
use DB;

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
        $events = DB::table('albums')->get();
        return view('pages.gallery', compact('albums'));
    }

    public function events() {
      $events = DB::table('events')->get();
      return view('pages.events', compact('events'));
    }

    public function recruitment() {
        return view('pages.recruitment');
    }

    public function profile(){
      return view('pages.profile');
    }

    public function members() {
      $members = DB::table('users')
        ->where('active_status', 1)
        ->orderby('roll_number')
        ->get();
        return view('pages.members', compact('members'));
    }

    public function alumni() {
      $alumni = DB::table('users')
        ->where('active_status', 0)
        ->orderby('roll_number')
        ->get();
        return view('pages.alumni', compact('alumni'));
    }

    public function contact() {
        return view('pages.contact');
    }

    public function retrieveImagesByAlbum($album)
    {
      $images = DB::table('images')
        ->where('album_id', '=', $album)
        ->get();
      return view("gallery.eventGallery", compact('images'));
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


}
