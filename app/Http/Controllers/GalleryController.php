<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Image;
use DB;
use Storage;
use File;

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
        $this->middleware('roles:exec,admin,chair');
    }

    public function editAlbum($album)
    {
      $album = DB::table('albums')
        ->where('id', '=', $album->id)
        ->first();

      return view('gallery.editAlbum', compact('album'));
    }

    function deleteAlbum(Album $album){
      DB::table('albums')
      ->where('id', '=', $album->id)
      ->delete();
      return \Redirect::to('/gallery');
    }

    function deleteImage(Album $album, Image $image){
      File::delete($image->file_path);
      File::delete($image->thumb_path);


      DB::table('images')
      ->where('id', '=', $image->id)
      ->delete();

      return \Redirect::to('/gallery/'.$album->id);
    }

    //stores a new photo in the uploads folder and puts the path and metadata in database
    public function storeImage(Request $request)
    {

      $this->validate($request, [
          'images' => 'required',
          'album_id' => 'required',
      ]);


      foreach ($request->images as $img){

        $extension = $img->getClientOriginalExtension();
        $fileName = $img->getClientOriginalName();
        $album = DB::table('albums')
          ->where('id', '=', $request->album_id)
          ->first();
        $publicPath = public_path();
        $filePath = "uploads/{$album->id}/{$fileName}";
        $request['filepath'] = $filePath;
        $request['image'] = $img;

        //this code checks to see if there is a file by that name already and changes it if so
        $nameWithoutExt = preg_replace('/\\.[^.\\s]{3,4}$/', '', $fileName);
        $existing = DB::table('images')->where('file_path', '=', $filePath)->first();
        $iterator = 1;
        while($existing != null){
          $fileName = $nameWithoutExt.$iterator.".".$extension;
          $filePath = "uploads/{$album->id}/".$fileName;
          $existing = DB::table('images')->where('file_path', '=', $filePath)->first();
          $iterator = $iterator+1;
        }

        $this->validate($request, [
            'image' => 'image'
        ]);

        //$img->move("uploads/{$album->id}", $fileName);
        $img = Imager::make(Input::file($img))->fit(1280, 720)->save("uploads/{$album->id}".$fileName);

        $image = new Image;

        $image->thumb_path = $this->createThumbnail($filePath, $extension);

        $image->description = $request->description;
        $image->file_path = $this->createResizedImage($filePath, $extension);
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
        $img = Imager::make($image)->fit(400, 300)->save($withoutExt.'_thumb.'.$extension);
        return $withoutExt.'_thumb.'.$extension;

    }

    public function createResizedImage($image, $extension)
    {
      $withoutExt = preg_replace('/\\.[^.\\s]{3,4}$/', '', $image);
        $img = Imager::make($image)->fit(1000, 800)->save($withoutExt.'_uploads.'.$extension);
        unlink($withoutExt.'.'.$extension);
        return $withoutExt.'_uploads.'.$extension;

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
      if($request->is_public == "Public"){
        $album->is_public = true;
      }
      else{
        $album->is_public = false;
      }

      //adding semester
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
      $album->semester_id = $semester->id;

      $album->event_id = $request->event_id;
      $album->save();

      return redirect()->action('HomeController@retrieveImagesByAlbum', [$album->id]);
    }

    public function update(Request $request, Album $album){
      $this->validate($request, [
          'name' => 'required',
          'description' => 'required',
          'location' => 'required'
      ]);

      $album->name = $request->name;
      $album->description = $request->description;
      $album->location = $request->location;

      if($request->is_public == "Public"){
        $album->is_public = true;
      }
      else{
        $album->is_public = false;
      }
      $album->save();

      return redirect()->action('HomeController@retrieveImagesByAlbum', [$album->id]);
    }
}
