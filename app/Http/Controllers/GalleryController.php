<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Image;
use DB;
use Storage;

use App\Album;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Redirect;

// import the Intervention Image Manager Class
use Intervention\Image\ImageManager;
use Illuminate\Support\Facades\Input;
use Intervention\Image\ImageManagerStatic as Imager;


class GalleryController extends Controller
{


  /* Require any user attempting to authenticate Gallery
	 * to be logged in
	 */
    public function __construct()
    {
        $this->middleware('auth');
    }

    //stores a new photo in the uploads folder and puts the path and metadata in database
    public function storeImage(Request $request)
    {

      $this->validate($request, [
          'images' => 'required',
          'album_id' => 'required',
      ]);


      foreach ($request->images as $img){

        //return var_dump($image);
        //$file = $request->file('images');
        //$file = $image;


        $extension = $img->getClientOriginalExtension();
        $fileName = $img->getClientOriginalName();
        $album = DB::table('albums')
          ->where('id', '=', $request->album_id)
          ->first();
        $publicPath = public_path();
        $filePath = "uploads/{$album->id}/{$fileName}";
        $request['filepath'] = $filePath;
        $request['image'] = $img;

        $this->validate($request, [
            'filepath' => 'unique:images,file_path',
            'image' => 'image'
        ]);

        $img->move("uploads/{$album->id}", $fileName);

        $image = new Image;

        $image->thumb_path = $this->createThumbnail($filePath, $fileName, $extension);

        $image->description = $request->description;
        $image->file_path = $filePath;
        $image->user_id = Auth::user()->id;
        $image->album_id = $request->album_id;
        $image->save();
      }

      return redirect()->action('HomeController@retrieveImagesByAlbum', [$request->album_id]);
    }

    //method to make Thumbnail copies of
    public function createThumbnail($image, $extension)
    {
      $withoutExt = preg_replace('/\\.[^.\\s]{3,4}$/', '', $image);
        $img = Imager::make($image)->resize(400, 300)->save($withoutExt.'_thumb'.$extension);
        return $withoutExt.'_thumb'.$extension;

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
        ->first();
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
