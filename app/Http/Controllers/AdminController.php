<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Bid;
use App\User;
use App\Semester;
use App\Role;
use App\Semester;
use DB;
use Mail;

class AdminController extends Controller
{

	/* Require any user attempting to authenticate social media
	 * to be logged in
	 */
    public function __construct()
    {
        // TODO THIS NEEDS TO BE MIDDLEWARE TO BLOCK IF NOT ADMIN OR EXEC $this->middleware('auth');
    }

	function showPanel(){
		return view('admin.panel');
	}


    function newClassForm(){
    	return view('admin.add_class');
    }

    function newSemesterForm(){
        return view('admin.new_semester');
    }


    function manageBrothersForm(){
    	$members = User::orderby('roll_number','asc')
	        ->with('image')->get();
        $roles = Role::orderby('rank_order')->where('active',1)->get();
	    return view('admin.manage_brothers', compact('members','roles'));
    }


    function manageRolesForm(){
        $roles = Role::orderby('rank_order')->where('active',1)->get();
        return view('admin.manage_roles',compact('roles'));
    }


	function recruitmentList() {
        $pnms = DB::table('pnms')->get();
        return view('admin.recruitmentList', compact('pnms'));
    }

	function getAttendanceSheet() {
		return view('admin.attendanceSheet');
	}


    function manageBrothersSubmit(Request $request){

        $semesterId = Semester::whereNull('date_end');

    }


    function manageRolesSubmit(Request $request){

        foreach( $request->role_id as $key => $id ){
            $role = "";
            if($id == "NEW"){
                // add a new role
                $role = new Role;

            }else{
                // edit existing role
                $role = Role::find($id);
            }

            $role->name = $request->name[$key];
            $role->type = $request->type[$key];
            $role->rank_order = $request->role_rank[$key];
            $role->save();
        }

        foreach( $request->retire as $key => $id ){
            $role = Role::find($id);
            $role->active = 0;
            $role->save();
        }

        return redirect("/admin/edit/roles");
    }


    function newClassSubmit(Request $request){

    	$this->validate($request, [
          'chapter_class' => 'required'
        ]);

    	foreach( $request->roll_number as $key => $val){


            $this->validate($request, [
                'roll_number['.$key.']' => 'required','unique:bids,roll_number'
            ]);

    		$token = $this->generateRandomString(80);

    		$bid = new Bid;
    		$bid->email = $request->email[$key];
    		$bid->roll_number = $request->roll_number[$key];
    		$bid->school_class = $request->school_class[$key];
    		$bid->chapter_class = $request->chapter_class;
    		$bid->token = $token;
    		$bid->created_at = date("Y-m-d h:i:s");

    		$bid->save();

    		Mail::send('emails.registration', ["token"=>$token,"class"=>$request->chapter_class], function ($message) use ($request,$key) {
			    $message->from('exec@thetataumiami.com', 'Theta Tau Miami');

			    $message->to($request->email[$key]);
			});
    	}



    	return redirect('/admin');

    }

    function newSemesterSubmit(Request $request){

        $this->validate($request,[
            'name' => 'required',
            'date_start' => 'required'
        ]);

        $lastSemester = Semester::whereNull('date_end')->get()->first();

        if($lastSemester){
            $lastSemester->date_end = $request->date_start;
            $lastSemester->save();
        }

        $newSemester = new Semester;
        $newSemester->name = $request->name;
        $newSemester->date_start = $request->date_start;
        $newSemester->save();

        return redirect("/admin");

    }




    function generateRandomString($length = 10) {
	    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	    $charactersLength = strlen($characters);
	    $randomString = '';
	    for ($i = 0; $i < $length; $i++) {
	        $randomString .= $characters[rand(0, $charactersLength - 1)];
	    }
	    return $randomString;
	}
}
