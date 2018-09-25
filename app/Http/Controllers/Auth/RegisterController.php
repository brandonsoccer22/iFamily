<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;


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
    protected $redirectTo = '/home';

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
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
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
        

        //set session varaibles
        //\Session::put('user_email', $data['email']);



        return User::create([
            'name' => $data['name'],
            'family_id' => $data['email'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

    public function add(Request $request){
        //parent adding a kid
        
       \Log::info("in Register");
        \Log::info(print_r($data,true));

        $data=array();

        $data=$request->all();

        \Log::info("in Register");
        \Log::info(print_r($data,true));


        if($date['user-type']=="child"){

            $date['user-type']=false;

            User::create([
            'name' => $data['name'],
            'family_id' => $data['parent-email'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'is_parent' => $date['user-type'],
        ]);

        //parent adding a parent
        }else if(isset($date['parent-email'])){

            User::create([
            'name' => $data['name'],
            'family_id' => $data['parent-email'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),            
        ]);
        } else{
            $message = "Unable to add family member";
            return view('home')->with('addError', $message);
        }

        $message = "Successfully added family member!";
        return view('home')->with('addSuccess', $message);


    }
}
