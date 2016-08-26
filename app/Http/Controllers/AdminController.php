<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class AdminController extends Controller
{


    function newClassForm(){
    	return view('admin.add_class');
    }

    function newClassSubmit(Request $request){

    	$this->validate($request, [
          'chapter_class' => 'required'
        ]);

    	// foreach($request->roll_number as $key => $val){
    	// 	$this->validate($request, [
	    //       'roll_number.'.$key => 'required',
	    //       'chapter_class.'.$key => 'required',
	    //       'school_class.'.$key => 'required'
	    //     ]);
    	// }


    	return "It worked!";

    }
}
