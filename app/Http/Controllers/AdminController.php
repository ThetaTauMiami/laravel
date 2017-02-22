<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Bid;
use App\User;
use App\Semester;
use App\Role;
use App\Event;
use App\Specialevent;
use DB;
use Carbon\Carbon;
use Mail;

class AdminController extends Controller
{

	/* Require any user attempting to authenticate social media
	 * to be logged in
	 */
    public function __construct()
    {
        $this->middleware('roles:exec,admin');
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
	        ->with('image')->with('roles')->get();
        $roles = Role::orderby('rank_order')->where('active',1)->get();
				$currSemester = $this->getCurrentSemester()->id;
	    return view('admin.manage_brothers', compact('members','roles', 'currSemester'));
    }


    function manageRolesForm(){
        $roles = Role::orderby('rank_order')->where('active',1)->get();
        return view('admin.manage_roles',compact('roles'));
    }




		function getAttendanceSheet() {
			$members = User::orderby('roll_number', 'asc')->where('active_status', 1)->get();
			$semester = app('App\Http\Controllers\HomeController')->getCurrentSemester();
			$attendance = DB::table('attendance')
			->get();
			$events = Event::where('semester_id', '=', $semester->id)->get();
			return view('admin.attendanceSheet', compact('members', 'attendance', 'events'));
		}

    function newSpecialeventForm(){

        return view('admin.specialevent_form');
    }

    function editSpecialeventForm($id){
        $event = Specialevent::find($id);

        return view('admin.specialevent_form', compact('event'));
    }


    function manageBrothersSubmit(Request $request){

        $semester_id = $this->getCurrentSemester()->id;

        foreach($request->id as $key => $id){

            if($request->role[$key] != ''){


                $current = DB::table('role_user')
                ->where([
                    ['user_id','=',$id],
                    ['semester_id','=',$semester_id]
                ])
                ->count();

                if($current > 0){

                    $current = DB::table('role_user')
                    ->where([
                        ['user_id','=',$id],
                        ['semester_id','=',$semester_id]
                    ])
                    ->update(['role_id'=>$request->role[$key]]);

                }else{
                    DB::table('role_user')->insert([
                        'user_id'=>$id,
                        'role_id'=>$request->role[$key],
                        'semester_id'=>$semester_id
                    ]);
                }

            }else{
                $current = DB::table('role_user')
                ->where([
                    ['user_id','=',$id]
                ])
                ->delete();
            }

        }

        return redirect('/admin/edit/brothers');

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

        if( isset($request->retire) ){
            foreach( $request->retire as $key => $id ){
                $role = Role::find($id);
                $role->active = 0;
                $role->save();
            }
        }

        return redirect("/admin/edit/roles");
    }


    function newClassSubmit(Request $request){

    	$this->validate($request, [
          'chapter_class' => 'required',
          'roll_number.0' => 'required'
        ]);

    	foreach( $request->roll_number as $key => $val){

    		$token = $this->generateRandomString(80);

    		$bid = new Bid;
    		$bid->email = $request->email[$key];
    		$bid->roll_number = $request->roll_number[$key];
    		$bid->school_class = '';
    		$bid->chapter_class = $request->chapter_class;
    		$bid->token = $token;
    		$bid->created_at = date("Y-m-d h:i:s");

    		$bid->save();

    		Mail::send('emails.registration', ["token"=>$token,"class"=>$request->chapter_class], function ($message) use ($request,$key) {
			    $message->from('noreply@thetataumiami.com', 'Theta Tau Miami');
                $message->subject('Welcome to Theta Tau!');

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
