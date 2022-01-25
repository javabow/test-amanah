<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

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
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
        $this->middleware('guest:admin');
        $this->middleware('guest:client');
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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    protected function validatorClient(array $data)
    {
        return Validator::make($data, [
            'name' => ['required|string|max:255'],
            'email' => ['required|string|email|max:255|unique:client'],
            'password' => ['required|string|min:6|confirmed'],
            'description' => ['nullable|string'],
            'image' => ['required|mimes:jpg,bmp,png'],
            'birthdate' => ['required|date_format:Y/m/d'],
            'mother' => ['required|string|max:50'],
            'father' => ['required|string|max:50'],
            'number_phone' => ['nullable|integer'],
            'instagram' => ['nullable|string'],
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
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

    public function showAdminRegisterForm()
    {
        return view('auth.register', ['url' => 'admin']);
    }

    public function showClientRegisterForm()
    {
        return view('auth.register', ['url' => 'client']);
    }

    protected function createAdmin(Request $request)
    {
        //
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ];

        $data = $request->all();
        $validator = Validator::make($data, $rules);
        $data = Hash::make($this->input('password'));
        User::create($data);

        return redirect()->intended('login/admin');
    }

    protected function createClient(Request $request)
    {
        //
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:client',
            'password' => 'required|string|min:6|confirmed',
            'description' => 'nullable|string',
            'image' => 'required|mimes:jpg,bmp,png',
            'birthdate' => 'required|date_format:Y/m/d',
            'mother' => 'required|string|max:50',
            'father' => 'required|string|max:50',
            'number_phone' => 'nullable|integer',
            'instagram' => 'nullable|string',
        ];

        $data = $request->all();
        $validator = Validator::make($data, $rules);
        $data = Hash::make($this->input('password'));
        Client::create($data);

        return redirect()->intended('login/client');
    }
}
