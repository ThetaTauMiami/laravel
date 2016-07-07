<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;

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
    public function index()
    {
        return view('home');
    }



    public function gallery() {
        return view('gallery');
    }

    public function events() {
        return view('events');
    }

    public function recruitment() {
        return view('recruitment');
    }

    public function members() {
        return view('members');
    }

    public function alumni() {
        return view('alumni');
    }

    public function contact() {
        return view('contact');
    }


}
