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
        return route('external-user.show', ["external_user" => Auth::user()]);
    } 

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }


    public function showExternalRegistrationForm()
    {
        return view('auth.register-external');
    }


    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

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
        switch(array_key_exists('external', $data)) {
            
            case false:
                return Validator::make($data, [
                    'username' => ['required', 'string', 'max:20', 'unique:users,username'], //username must not exist in users -> username column in db
                    'user_type' => ['required', 'string', 'max:13', Rule::in(User::USER_TYPES)],
                    'password' => ['required', 'string', 'min:5', 'confirmed']
                ]);
            case true:
                return Validator::make($data, [
                    'member_id' => ['exists:members,id'],
                    'email' => ['required', 'string', 'exists:members,email'],
                    'password' => ['required', 'string', 'min:8', 'confirmed']
                ]);
            default:
                return;
        }

    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        switch(array_key_exists('external', $data)) {
            
            case false:
                return User::create([
                    'username' => $data['username'],
                    'user_type' => $data['user_type'],
                    'password' => Hash::make($data['password']),
                ]);
            case true:
                return ExternalUser::create([
                    'member_id' => $data['external'],
                    'email' => $data['email'],
                    'password' => Hash::make($data['password'])
                ]);
            default:
                return;    
        }
    } 
}
