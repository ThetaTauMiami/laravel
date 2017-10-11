<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use App\Event;
use Auth;
use App\Image;
use DB;
use Illuminate\Support\Facades\Redirect;
use Intervention\Image\ImageManagerStatic as Imager;

class ProfileController extends Controller
{

  /* Require any user attempting to use profile functions
   * to be logged in
   */
    public function __construct()
    {
        $this->middleware('auth');
    }

    //if someone tries to go to '/editprofile, redirects to /editprofile/$id'
    function editMyProfile(){
      $profile_id = Auth::id();
      //$loggedinuser = Auth::user();
      return editProfile($profile_id);
    }

    function getUserAttendanceSheet(User $user) {
      //check if is user or if is exec
      $loggedinuser = Auth::user();
      $roles = $loggedinuser->roles()->getResults();
      $exec = false;
      foreach ($roles as $role){
        if($role->type == "exec" || $role->type == "admin"){
          $exec = true;
        }
      }
      if($user->id == $loggedinuser->id || $exec){
  			$semester = app('App\Http\Controllers\HomeController')->getCurrentSemester();
  			$attendance = DB::table('attendance')
        ->where('user_id', '=', $user->id)
  			->get();
  			$events = Event::where('semester_id', '=', $semester->id)->get();
  			return view('admin.userAttendanceSheet', compact('attendance', 'events', 'user'));
      }
      return redirect('members/');
		}

    //editProfile page
    function editProfile(User $user){
      return view('pages.editProfile', compact('user'));

    }

    //updates user values, and if an image has been uploaded, stores it and creates a thumbnail
    function update(Request $request, User $user){
      //$user->update($request->all());
      if($user->id == Auth::id() || isExecOrAdmin()){
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->school_class = $request->school_class;
        $user->major = $request->major;
        $user->minor = $request->minor;
      }

      //UPDATE RESUME SCHTUFF
      if($request->resume){
        $res = $request->file('resume');
        $extension = $res->getClientOriginalExtension();
        $fileName = $res->getClientOriginalName();


        $publicPath = public_path();
        $filePath = "uploads/prof/resumes/".$fileName;
        $request['filepath'] = $filePath;
        $request['resume'] = $res;

        //this code checks to see if there is a file by that name already and changes it if so
        $nameWithoutExt = preg_replace('/\\.[^.\\s]{3,4}$/', '', $fileName);
        $existing = DB::table('users')->where('resume_path', '=', $filePath)->first();
        $iterator = 1;
        while($existing != null){
          $fileName = $nameWithoutExt.$iterator.".".$extension;
          $filePath = "uploads/prof/resumes/".$fileName;
          $existing = DB::table('users')->where('resume_path', '=', $filePath)->first();
          $iterator = $iterator+1;
        }


        //Do some validation stuff. I'm gonna be honest here,
        //I don't really know why we have to do this or what's actually
        //happening, but eveyone else on the tech committee says that it's
        //important. --Sam Mallamaci
        $this->validate($request, [
          'resume' => 'file'
        ]);

        //get rid of old resume
        if(!is_null($user) && file_exists($user->resume_path))
          unlink($user->resume_path);
        //AND NOW WE KERPLUNK THE RESUME INTO THE FOLDER
        //THIS IS SOMETHING THAT I UNDERSTAND
        $res->move("uploads/prof/resumes/", $fileName);

        $user->resume_path = $filePath;
      }

      //is there a value in the image section?
      if($request->image){

        //$img is the newly uploaded file
        $img = $request->file('image');
        $extension = $img->getClientOriginalExtension();
        $fileName = $img->getClientOriginalName();

        $publicPath = public_path();
        $filePath = "uploads/prof/".$fileName;
        //gets filePath without the extension, like .JPG
        $withoutExt = preg_replace('/\\.[^.\\s]{3,4}$/', '', $filePath);
        $nameWithoutExt = preg_replace('/\\.[^.\\s]{3,4}$/', '', $fileName);
        $request['filepath'] = $filePath;
        $existing = DB::table('images')->where('file_path', '=', $filePath)->first();
        $iterator = 1;
        //this code checks to see if there is a file by that name already and changes it if so
        while($existing != null){
          $filePath = $withoutExt.$iterator.".".$extension;
          $fileName = $nameWithoutExt.$iterator.".".$extension;
          $iterator = $iterator+1;
          $existing = DB::table('images')->where('file_path', '=', $filePath)->first();
        }
        $request['image'] = $img;

        //validates that the new filepath and image are unique I guess, ask Cole.
        $this->validate($request, [
            'image' => 'image'
        ]);

        //sticks the new image into the folder
        $img->move("uploads/prof/", $fileName);

        //Stick that there image into this here database
        $image = new Image;
        $image->file_path = $filePath;
        $image->user_id = $user->id;

        //creates the thumbnail image and associates it with the uploaded image
        $image->thumb_path = $this->createThumbnail($filePath, $extension);

        $image->save();

        //and now make the user point to the new image and delete old image
        $oldImage = Image::where('id', '=', $user->image_id)->first();
        if(!is_null($oldImage) && file_exists($oldImage->file_path))
          unlink($oldImage->file_path);
        if(!is_null($oldImage) && file_exists($oldImage->thumb_path))
          unlink($oldImage->thumb_path);
        DB::table('images')
        ->where('id', '=', $user->image_id)
        ->delete();
        $user->image_id = $image->id;



      }//end image saving/replacing
      $user->save();
      return redirect('members/'.$user->id);
    }

    public function createThumbnail($image, $extension)
    {

      $withoutExt = preg_replace('/\\.[^.\\s]{3,4}$/', '', $image);
        $img = Imager::make($image)->fit(300, 300)->save($withoutExt.'_thumb.'.$extension);
        return $withoutExt.'_thumb.'.$extension;
    }

    public function removeResume(User $user)
    {
      if(Auth::id()==$user->id){
        unlink($user->resume_path);
        $user->resume_path = null;
        $user->save();
      }
      return redirect('members/'.$user->id);
    }
}
