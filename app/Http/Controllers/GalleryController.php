<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Image;
use DB;
use Storage;
use Input;
use App\Album;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Redirect;

class GalleryController extends Controller
{


  /* Require any user attempting to authenticate social media
	 * to be logged in
	 */
    public function __construct()
    {
        $this->middleware('auth');
    }

    //stores a new photo in the uploads folder and puts the path and metadata in database
    public function storeImage(Request $request)
    {

      $file = $request->file('image');
      $extension = $file->getClientOriginalExtension();
      $fileName = $file->getClientOriginalName();
      $album = DB::table('albums')
        ->where('id', '=', $request->album_id)
        ->first();
      $publicPath = public_path();
      $filePath = "uploads/{$album->id}/{$fileName}";
      $request['filepath'] = $filePath;
      $this->validate($request, [
          'image' => 'required',
          'album_id' => 'required',
          'filepath' => 'unique:images,filepath'
      ]);

      $file->move("uploads/{$album->id}", $fileName);



      $image = new Image;
      $image->description = $request->description;
      $image->filepath = $filePath;
      $image->user_id = Auth::user()->id;
      $image->album_id = $request->album_id;
      $image->save();


      return redirect()->action('HomeController@retrieveImagesByAlbum', [$image->album_id]);
    }

    //creating new albums
    public function storeAlbum(Request $request)
    {
      $this->validate($request, [
          'name' => 'required',
          'description' => 'required',
          'location' => 'required'
      ]);

      $album = new Album;
      $album->name = $request->name;
      $album->description = $request->description;
      $album->location = $request->location;
      $album->user_id = Auth::user()->id;

      //adding semester
      $today = Carbon::today()->toDateString();
      $semester = DB::table('semesters')
        ->whereDate('date_start', '<=', $today)
        ->whereDate('date_end', '=', NULL)
        ->get();
      if($semester == NULL){
        $semester = DB::table('semesters')
          ->whereDate('date_start', '<=', $today)
          ->whereDate('date_end', '>', $today)
          ->first();
      }
      $album->semester_id = $semester->id;

      $album->event_id = $request->event_id;
      $album->save();

      return redirect()->action('HomeController@retrieveImagesByAlbum', [$album->id]);
    }
}
