<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    //

    /**
	*Return a page for the parent to add users
    */
    public function index(Request $request){

    }


    //set the current value of the user
    public function setUser(Request $request){

    	$user = $request->user();

    	\Log::info(print_r($user,true));
    	\Log::info(print_r($user->all(),true));
    	\Log::info("In UserController");

    	return view('home')->with('user',$user);
    }
}
