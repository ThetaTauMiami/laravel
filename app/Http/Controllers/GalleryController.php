<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use DB;

class GalleryController extends Controller
{
    //
    public function RetrieveAll()
    {
      $images = DB::table('images')->get();
      return view('pages.gallery', compact('images'));
    }

    public function RetrieveByUploader($uploader)
    {
      $images = DB::table('images')
        ->where('user_id', '=', $uploader);
      return view('pages.gallery', compact('images'));
    }
}
