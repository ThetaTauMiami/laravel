<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use Socialite;

class SocialMediaController extends Controller
{

	/* Require any user attempting to authenticate social media 
	 * to be logged in
	 */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Redirect the user to the authentication page.
     *
     * @return Response
     */
    public function LinkedInRedirectToProvider()
    {
        return Socialite::driver('linkedin')->redirect();
    }

    /**
     * Obtain the user information from callback and redirect.
     *
     * @return Response
     */
    public function LinkedInHandleProviderCallback()
    {
        $oauthuser = Socialite::driver('linkedin')->user();

        $user = auth()->user();

        $user->linkedin_token = $oauthuser->token;

        $user->save();

        return redirect()->route('/');

    }
    
}
