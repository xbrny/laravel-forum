<?php

namespace App\Http\Controllers\Auth;

use SocialAuth;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

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
    }

    public function redirectServiceProvider($provider)
    {
        return SocialAuth::authorize($provider);
    }

    public function handleProviderCallback($provider)
    {
        SocialAuth::login($provider, function ($user, $details) {
            $user->name = $details->full_name;
            $user->avatar = $details->avatar;
            $user->email = $details->email;
            $user->save();
        });

        return redirect()->route('home');
    }
}
