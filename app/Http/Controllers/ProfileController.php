<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use Auth;
use App\Image;
use DB;
use Intervention\Image\ImageManagerStatic as Imager;

class ProfileController extends Controller
{

  /* Require any user attempting to event
   * to be logged in
   */
    public function __construct()
    {
        $this->middleware('auth');
    }

    //
    function editMyProfile(){
      $profile_id = Auth::id();
      return editProfile($profile_id);
    }

    function editProfile(User $user){
      /*$member = DB::table('users')
      ->where('id', $profile_id)
      ->first();*/

      $image = DB::table('images')
      ->where('id', $user->image_id)
      ->get();

      return view('pages.editProfile', compact('user', 'image'));
    }

    function update(Request $request, User $user){
      $user->update($request->all());

      //is there a value in the image section?
      if($request->image){
        //$thumbnail = new Image;
        //return var_dump($request->image);
        $img = $request->file('image');

        $extension = $img->getClientOriginalExtension();
        $fileName = $img->getClientOriginalName();
        $publicPath = public_path();
        $filePath = "uploads/Profile_Full/{$fileName}";
        $request['filepath'] = $filePath;

        $this->validate($request, [
            'filepath' => 'unique:images,file_path'
        ]);

        $img->move("uploads/Profile_Full", $fileName);
        //$img = Imager::make($filePath)->resize(200, 200)->save($filePath);

        //Stick that there image into this here database
        $image = new Image;
        $image->file_path = $filePath;
        $image->user_id = $user->id;
        //$image->thumb_path = $filePath;

        //Now make a neat thumbnail for the image

        createThumbnail()
        $image->save();

        //and now make the user point to the new image
        $user->image_id = $image->id;
      }

      return back();
    }
    public function createThumbnail($image, $extension)
    {
      $withoutExt = preg_replace('/\\.[^.\\s]{3,4}$/', '', $image);
        $img = Imager::make($image)->resize(400, 300)->save($withoutExt.'_thumb'.$extension);
        return $withoutExt.'_thumb'.$extension;
    }
}
