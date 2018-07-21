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
    protected $redirectTo = '/dashboard';

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
        //Check if user need to change their password
        $passwordChanged = User::where('email', $request->input('email'))->value('password_changed');
        if ($passwordChanged == 1) {
            //Login user and redirect them to dashboard
            $credentials = $request->only('email', 'password');

            if (Auth::attempt($credentials)) {
                return redirect()->intended('dashboard');
            }else{
                return Redirect::back()->withErrors(['Invalid email address and/or password', 'Invalid phone number and/or password' ]);
            }

        } else {
            //Login user and redirect them to change their password
            $credentials = $request->only('email', 'password');

            if (Auth::attempt($credentials)) {
                return redirect()->intended('users/change-password');
            }else{
                return Redirect::back()->withErrors(['Invalid email address and/or password', 'Invalid phone number and/or password' ]);
            }
        }
    }

    //Change Password
    public function changePassword(Request $request){
        $username = Auth::user()->email;
        $password = $request->input('oldPass');

        if (Auth::attempt(['email' => $username, 'password' => $password])) {
            User::where('id', Auth::user()->id)->update([
                'password' => Hash::make($request->input('newPass'), ['rounds' => 12]),
                'password_changed' => 1
            ]);

            return array(
                'res'=>1,
                'message' => 'Password has been changed. Redirecting ... ',
                'redirect'=>'/dashboard'
            );
        }else{
            return array(
                'res'=>0,
                'message'=>'Invalid email and/or password'
            );
        }
    }

    //Load change password page
    public function getChangePasswordPage(){
        return view('auth.change-password');
    }

    public function logout(){
        Auth::logout();
        return redirect('/login');
    }
}
