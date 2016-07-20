<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

// Note: Middleware to be applied on controller in __construct(), not routes level ~MD
// All routes in this file have the 'Web' middleware applied, and is not designed for RESTful APIs
// 		refer to app/Providers/RouteServiceProvider to manage default route middleware




/* +--------------------------------------+
   | Public/Home Routes                   |
   +--------------------------------------+
*/


Route::get('/', 			'HomeController@index');
Route::get('gallery', 		'HomeController@gallery');
Route::get('events', 		'EventsController@index');
Route::get('recruitment', 	'HomeController@recruitment');
Route::get('members', 		'HomeController@members');
Route::get('alumni', 		'HomeController@alumni');
Route::get('contact', 		'HomeController@contact');
Route::get('gallery/{event}', 		'GalleryController@retrieveByEvent');




/* +--------------------------------------+
   | Private/User Routes                  |
   +--------------------------------------+
*/


///// TODO /////
Route::group( [ 'middleware' => ['web'] ], function ()
{
	Route::get('createEvent', 'HomeController@createEvent');
	Route::post('createEvent', 'EventsController@store');
	Route::post('gallery', 'GalleryController@store');
});

/* +--------------------------------------+
   | USER AUTHORIZATION ROUTES            |
   +--------------------------------------+
*/

// These routes are located in the following file and map to 'Auth\AuthController'
// vendor/laravel/framework/src/Illuminate/Routing/Router.php ~MD
Route::auth();


Route::get('/linkedin',
	'Auth\SocialMediaController@LinkedInRedirectToProvider');
Route::get('/linkedin/callback',
	'Auth\SocialMediaController@LinkedInHandleProviderCallback');



/* +--------------------------------------+
   | Maintenance Routes                   |
   +--------------------------------------+
*/

Route::get('/deploy', 'Maintenance@deploy');
