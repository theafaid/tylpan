<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

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


    protected $country;
    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/profile';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
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
            'first_name' => ['required', 'string', 'max:255'],
            'middle_name' => ['nullable', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'first_name' => $data['first_name'],
            'middle_name' => $data['middle_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'country_id' => $this->country->id
        ]);
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        if(! $this->validCountry() || ! $this->country) {
            return $this->invalidCountry();
        }

        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        $this->guard()->login($user);

        session()->flash('registered', $this->registeredMeassage($user));

        return $this->registered($request, $user)
            ?: redirect($this->redirectPath());
    }

    /**
     * Check if the user country is not supported
     * It will be not support in case if (we don't allow it) or (failed to fetch it from geoplugin.net)
     * @return bool
     */
    protected function validCountry()
    {
        $countryData = json_decode(file_get_contents('http://www.geoplugin.net/json.gp'));

        if(! $countryData->geoplugin_countryCode) return false;

        $userCountry = Country::where('alpha2_code', $countryData->geoplugin_countryCode)->where('travel_from', true)->first();

        $this->country = $userCountry;

        return $userCountry;
    }

    /**
     * Message if for the successfully registered user
     * @param $user
     * @return string
     */
    protected function registeredMeassage($user)
    {
        return "Welcome {$user->defaultName}, you have successfully registered. Start now by just completing your profile then create your order";
    }

    /**
     * Redirection with invalid country message
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function invalidCountry()
    {
        return back()->with([
            'invalidCountry' => 'Sorry, Currently Your country is not supported yet. Hope soon we will support it :)'
        ]);
    }
}
