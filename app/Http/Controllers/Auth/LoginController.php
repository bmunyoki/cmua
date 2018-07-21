<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Redirect;
use Hash;

use App\User;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/room-allocation';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    /*public function __construct(){
        $this->middleware('guest')->except('logout');
    }*/

    public function getLoginPage(){
        if(Auth::check())
            return redirect('/dashboard');
        
        return view('auth.login');
    }

    public function processLogin(Request $request){
        //Login user and redirect them to dashboard
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return redirect()->intended('/room-allocation');
        }else{
            return Redirect::back()->withErrors(['Invalid email address and/or password', 'Invalid phone number and/or password' ]);
        }
    }

    public function logout(){
        Auth::logout();
        return redirect('/login');
    }
}
