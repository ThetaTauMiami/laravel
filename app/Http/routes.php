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
Route::get('gallery/semester/{semester}', 		'HomeController@gallerySemester');
Route::get('events', 		'HomeController@events');
Route::get('recruitment', 	'HomeController@recruitment');
Route::get('recruitment/signup', 	'HomeController@recruitmentSignUp');
Route::post('recruitment/signup', 	'HomeController@recruitmentSubmit');
Route::get('members', 		'HomeController@members');
Route::get('members/{user}', 'HomeController@profile');
Route::get('members/{user}/resume', 'HomeController@resume');
Route::get('members/{user}/attendance',      'ProfileController@getUserAttendanceSheet'); //should be only accessible to admin or that user

Route::get('resumes',      'HomeController@resumes');
Route::post('resumes',     'HomeController@resumes');

Route::get('companies',    'HomeController@companies');

Route::get('companies',     'HomeController@companies');
Route::get('companies/update',     'HomeController@updateCompanies');

Route::get('alumni', 		'HomeController@alumni');
Route::get('contact', 		'HomeController@contact');
Route::post('contact',     'HomeController@contactSubmit');

Route::get('profile',      'HomeController@profile');

Route::get('gallery/{album}', 		'HomeController@retrieveImagesByAlbum');
Route::get('gallery/{album}/edit', 'GalleryController@editAlbum');
Route::patch('gallery/{album}/edit', 'GalleryController@update');
Route::get('gallery/{album}/delete', 'GalleryController@deleteAlbum');
Route::get('gallery/{album}/{image}/delete', 'GalleryController@deleteImage');

Route::get('createEvent', 'EventsController@createEvent');


Route::get('events/{event}', 'HomeController@retrieveIndividualEvent');
Route::get('events/{event}/order', 'EventsController@whichOrder');
Route::get('events/{event}/attendance/{type}', 'EventsController@takeAttendance');
Route::get('events/{event}/attendance_variable', ['as' => 'variable', 'uses' => 'EventsController@takeAttendanceVariable']);
Route::post('events/{event}/attendance', 'EventsController@saveAttendance');
Route::patch('events/{event}/attendance/variable', 'EventsController@saveVariableAttendance');
Route::get('events/edit/{event}', 'EventsController@editEvent');
Route::get('events/{event}/delete', 'EventsController@deleteEvent');

Route::get('editProfile/{user}', 'ProfileController@editProfile');
Route::get('editProfile/{user}/removeresume', 'ProfileController@removeResume');
Route::get('editProfile', 'ProfileController@editMyProfile');

Route::get('phpinfo',    'HomeController@phpinfo');

// **Note: /event/ is different than /events/, /event/ is for special event registration and is separate
Route::get ('event/{slug}', 'HomeController@specialEventShow');
Route::post('event/{id}', 'HomeController@specialEventStore');

//New route that allows editing of the recruitment page
Route::get ('editRecruitmentEvent/{id}', 'HomeController@editRecruitmentEvent');

Route::get ('createRecruitmentEvent', 'HomeController@createRecruitmentEvent');

Route::get('recruitmentEvent/{event}/delete', 'HomeController@deleteRecruitmentEvent');
// redirect /home route to the root directory
Route::get('home', function () {
    return redirect('/');
});


/* +--------------------------------------+
   | Private/User Routes                  |
   +--------------------------------------+
*/
//Patch Routes
Route::patch('editProfile/{user}', 'ProfileController@update');
Route::patch('events/edit/{event}', 'EventsController@update');
//recruitmentEvent patch Route
Route::patch('editRecruitmentEvent/{recruitmentEvent}', 'HomeController@update');



// =============== Chair Accessible Pages ===============

Route::get('chair',   'ChairController@showPanel');

Route::get ('recruitment/list',      'ChairController@recruitmentList');
Route::post('recruitment/list',      'ChairController@recruitmentListDelete');

Route::get  ('specialevents/new',   'ChairController@newSpecialEventForm');
Route::post ('specialevents/new',   'ChairController@newSpecialEventSubmit');
Route::get  ('specialevents',       'ChairController@listSpecialEvents');
Route::get  ('specialevents/{id}',  'ChairController@editSpecialEventForm');
Route::patch('specialevents/{id}',  'ChairController@editSpecialEventSubmit');
Route::get  ('specialevents/{id}/attendees',  'ChairController@specialEventDownload');


// =============== Admin Panel ===============

Route::get('admin',                'AdminController@showPanel');

Route::get('admin/new/class',      'AdminController@newClassForm');
Route::post('admin/new/class',     'AdminController@newClassSubmit');

Route::get('admin/new/semester',      'AdminController@newSemesterForm');
Route::post('admin/new/semester',     'AdminController@newSemesterSubmit');

Route::get('admin/edit/brothers',   'AdminController@manageBrothersForm');
Route::post('admin/edit/brothers',   'AdminController@manageBrothersSubmit');

Route::get('admin/attendance',      'AdminController@getAttendanceSheet');

Route::get('admin/edit/roles',      'AdminController@manageRolesForm');
Route::post('admin/edit/roles',      'AdminController@manageRolesSubmit');

Route::get('admin/sendAttendance',      'AdminController@sendAttendanceReminderEmail');



// ============= End Admin Panel =============



//Post routes
Route::post('createEvent', 'EventsController@store')->middleware("roles:admin,exec,chair");
Route::post('editProfile', 'ProfileController@store')->middleware("roles:admin,exec,chair");
Route::post('gallery', 'GalleryController@storeAlbum')->middleware("roles:admin,exec,chair");
Route::post('gallery/{album}', 'GalleryController@storeImage')->middleware("roles:admin,exec,chair");
Route::post('createRecruitmentEvent', 'HomeController@store')->middleware("roles:admin,exec,chair");

/* +--------------------------------------+
   | USER AUTHORIZATION ROUTES            |
   +--------------------------------------+
*/

// ============ START USER AUTH =================
   //modified from vendor/laravel/framework/src/Illuminate/Routing/Router.php ~MD
   //Route::auth();

   // Login Routes
   Route::get('login', 'Auth\AuthController@showLoginForm');
   Route::post('login', 'Auth\AuthController@login');
   Route::get('logout', 'Auth\AuthController@logout');

   // Registration Routes...
   Route::get('register','Auth\AuthController@showTokenError');// added to support token
   Route::get('register/{registration_token}', 'Auth\AuthController@showRegistrationForm');
   Route::post('register', 'Auth\AuthController@register');

   Route::get('welcome', 'HomeController@welcome');

   Route::get('download/attendance', 'AdminController@userExcel');
   Route::get('download/events', 'AdminController@eventExcel');

   // Password Reset Routes...
   Route::get('password/reset/{token?}', 'Auth\PasswordController@showResetForm');
   Route::post('password/email', 'Auth\PasswordController@sendResetLinkEmail');
   Route::post('password/reset', 'Auth\PasswordController@reset');

// ============ END USER AUTH =================


Route::get('/linkedin',
	'Auth\SocialMediaController@LinkedInRedirectToProvider');
Route::get('/linkedin/callback',
	'Auth\SocialMediaController@LinkedInHandleProviderCallback');




/* +--------------------------------------+
   | Maintenance Routes  (not used)       |
   +--------------------------------------+
*/

Route::get('/deploy', 'Maintenance@deploy');
