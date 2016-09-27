<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Bid;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware($this->guestMiddleware(), ['except' => 'logout']);
    }

    protected function showTokenError(){
        return view('auth.registration_error');
    }

    /**
     * == Overloaded from vendor class to account for token == ~Matt D.
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showRegistrationForm($registration_token)
    {
        if (property_exists($this, 'registerView')) {
            return view($this->registerView);
        }

        return view('auth.register', ['registration_token'=>$registration_token]);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'phone' => 'required|min:13|max:13|regex:/\([0-9][0-9][0-9]\)[0-9][0-9][0-9]-[0-9][0-9][0-9][0-9]/',
            'email' => 'required|email|max:255|unique:users|exists:bids,email|unique:users,email',
            'major' => 'required',
            'password' => 'required|min:8|confirmed|regex:/(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[A-Za-z\d]{8,}/',//8 characters, at least 1 alpha, at least 1 number, at least 1 special character
            'registration_token' => 'exists:bids,token'
        ], [
            // Custom Error Messages
            'email.exists' => 'Your email address had not been officially given a bid to Theta Tau. If you find this in error please contact exec.',
            'email.unique' => 'An account already exists with your email address.',
            'password.regex' => 'Your password must contain at least one uppercase letter, one lowercase letter, and one number',
            'registration_token.exists' => 'Your validation token does not match a bid from Theta Tau. Ensure you open the entire link from your email, and contact exec if the problem persists.'

        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {

        $this->redirectTo = '/welcome';

        $bid = Bid::find($data['registration_token']);


        return User::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'phone' => preg_replace('/[^0-9]/','',$data['phone']), // replace all non-numbers
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'major' => $data['major'],
            'minor' => $data['minor'],
            'chapter_class' => $bid->chapter_class,
            'roll_number' => $bid->roll_number,
            'school_class' => $bid->school_class

        ]);
    }

    
}
