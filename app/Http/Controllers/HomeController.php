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
        $events = DB::table('events')->get();
        return view('pages.gallery', compact('events'));
    }

    public function events() {
        return view('pages.events');
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

    public function createEvent() {
      if (!Auth::check()){
        return redirect('/login');
      }
      else{
        return view('pages.createEvent');
      }
    }

    public function login() {
        return view('auth.login');
    }


}
