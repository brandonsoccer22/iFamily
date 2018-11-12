<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

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
        
        //\Session::put('status', 'logged_in');
        //\Session::save();
        $this->middleware('guest')->except('logout');
    }

    public function logout (Request $request) {
    
    $data=$request->all();
    //logout user
    auth()->logout();
    \Session::flush();
    // redirect to homepage
    if(isset($data['state']) && $data['state']=='deleted'){
        return view('home')->with('addError','You are deleted');
    } else{
    return redirect('/');
    }
}
}
