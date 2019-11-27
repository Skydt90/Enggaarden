<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\ExternalUser;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected function redirectTo()
    {
        if(is_null(Auth::user()->member)) {
            session()->flash('status', 'Bruger oprettet korrekt');
            return route('register');
        }
        return route('ext-home', ["external_user" => Auth::user()]);
    } 

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->only(['showRegistrationForm', 'register']);
        $this->middleware('guest:external');
        $this->middleware('guest')->except(['showRegistrationForm', 'register']);
    }


    public function showExternalRegistrationForm()
    {
        return view('auth.register-external');
    }


    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        //$this->guard()->login($user);

        return $this->registered($request, $user)
                        ?: redirect($this->redirectPath());
    }

    public function registerExternal(Request $request)
    {
        $this->validateExternal($request);

        event(new Registered($user = $this->createExternal($request->all())));

        $this->guard()->login($user);

        return $this->registered($request, $user) ?: redirect($this->redirectPath());
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
            'username' => ['required', 'string', 'max:20', 'unique:users,username'], //username must not exist in users -> username column in db
            'user_type' => ['required', 'string', 'max:13', Rule::in(User::USER_TYPES)],
            'password' => ['required', 'string', 'min:5', 'confirmed']
        ]);
    }

    protected function validateExternal(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return User::create([
            'username' => $data['username'],
            'user_type' => $data['user_type'],
            'password' => Hash::make($data['password']),
        ]);   
    }

    protected function createExternal(array $data)
    {
        return ExternalUser::create([
            'email' => $_GET['email'],
            'password' => Hash::make($data['password']),
            'member_id' => $_GET['id'],
        ]);   
    }
}
