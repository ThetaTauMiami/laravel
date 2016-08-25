<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Image;
use DB;
use Storage;
use Input;

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
    public function store(Request $request)
    {

      $file = $request->file('image');
      $extension = $file->getClientOriginalExtension();
      $fileName = $file->getClientOriginalName();
      $event = DB::table('events')
        ->where('id', '=', $request->event_id)
        ->first();
      $publicPath = public_path();
      $filePath = "uploads/{$event->eventName}/{$fileName}";
      $request['filepath'] = $filePath;
      $this->validate($request, [
          'image' => 'required',
          'user_id' => 'required',
          'event_id' => 'required',
          'filepath' => 'unique:images,filepath'
      ]);

      $file->move("uploads/{$event->eventName}", $fileName);



      $image = new Image;
      $image->description = $request->description;
      $image->filepath = $filePath;
      $image->user_id = $request->user_id;
      $image->album_id = $request->album_id;
      $image->save();


      return \Redirect::to('/gallery');
    }
}
