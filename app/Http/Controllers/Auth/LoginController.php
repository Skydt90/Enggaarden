<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\ExternalUser;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('guest:external')->except('logout');
    }

    public function username()
    {
        return 'username';
    }

    public function showExternalLogin()
    {
         return view('auth.login-external');
    }

    public function externalLogin(Request $request)
    {
        $this->validateExternalLogin($request);

        if (Auth::guard('external')->attempt([
            'email' => $request->email,
            'password' => $request->password], $request->get('remember'))) {
            
            return redirect()->intended('/external-user');
        }
        return $this->sendFailedLoginResponse($request);      
    }

    protected function validateExternalLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|string',
            'password' => 'required|string',
        ]);
    }

    /**
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        if (isset($this->guard()->user()->user_type)){
            $link = '/login';
        } else {
            $link = '/login-external';
        }
        $this->guard()->logout();

        $request->session()->invalidate();

        return redirect($link);
    }
}
