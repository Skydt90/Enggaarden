<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateUserRequest;
use App\Models\ExternalUser;
use App\Models\User;
use Exception;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

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
        return route('ext-home', ["external_user" => Auth::user()]);
    } 

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('can:administrate')->only(['showRegistrationForm', 'register']);
        $this->middleware('guest:external');
        $this->middleware('guest')->except(['showRegistrationForm', 'register']);
    }


    public function showExternalRegistrationForm()
    {
        //Burde muligvis refactores med service og repo lag
        $test = ExternalUser::where('email', $_GET['email'])->get();
        if ($test->isNotEmpty()){
            return redirect(route('login-ext'));
        }
        return view('auth.register-external');
    }

    public function register(CreateUserRequest $request)
    {
        try {
            event(new Registered($user = $this->create($request->all())));
        } catch (Exception $e) {
            Log::error('RegisterController@store: ' . $e);
            return response()->json([
                'status' => 500,
                'message' => json_encode($e->__toString())
            ], 500);
        }
        return response()->json([
            'status' => 200,
            'message' => 'Bruger oprettet korrekt',
            'data' => $user
        ], 200);
    }

    // LEFT HERE FOR NOW IN CASE WE GET ISSUES WITH AJAX REGISTRATION
    /* public function register(CreateUserRequest $request)
    {
        // Because we made a custom request validation happens automatically
        // $this->validator($request->all())->validate();
        event(new Registered($user = $this->create($request->all())));
        // Man kan kun registrere brugere som admin, derfor skal
        // en nyligt registreret bruger ikke logges ind
        //
        // $this->guard()->login($user);
        return $this->registered($request, $user)
                        ?: redirect(route('register'))->withStatus('Bruger oprettet korrekt');
    } */

    public function registerExternal(Request $request)
    {
        $this->validateExternal($request);

        event(new Registered($user = $this->createExternal($request->all())));

        // $this->guard()->login($user);

        return $this->registered($request, $user) ?: redirect($this->redirectPath());
    }

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
            'email' => 'required|string|email|unique:external_users,email|exists:members,email',
            'password' => 'required|string|confirmed',
        ]);
    }

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
