<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
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
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        \Log::info(print_r(Auth::user(),true));
        \Log::info(Auth::id());
        //\Log::info(Auth::user()->email);
        \Log::info(print_r(Auth::user(),true));
        \Log::info("Hello Worlds");
        \Session::put('status', 'logged_in');
        \Session::save();
        $this->middleware('guest')->except('logout');
    }

    public function logout () {
    //logout user
    auth()->logout();
    \Session::flush();
    // redirect to homepage
    return redirect('/');
}
}
