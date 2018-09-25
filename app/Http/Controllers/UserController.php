<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;
use Exception;

class UserController extends Controller
{
    //

    /**
	*Return a page for the parent to add users
    */
    public function index(Request $request){
    	$user = $request->user();    	

    	return view('add_user');
    }


    //set the current value of the user
    public function setUser(Request $request){

    	$user = $request->user(); 

    	$family= User::getFamily($user['family_id']);

    	$user['family']=$family;

    	\Session::put('user', $user); 	
    	\Session::save();

    	return view('home');
    }

    public function addUser(Request $request){
        //parent adding a kid
        $user = $request->user();    	
       

        $data=array();

        $data=$request->all();

       

        \Log::info("in addUser, data=");
        \Log::info(print_r($data,true));


        if($data['user-type']=="child"){

            $data['user-type']=false;

            

             try {
				   User::create([
		            'name' => $data['name'],
		            'family_id' => $data['parent-email'],
		            'email' => $data['email'],
		            'password' => Hash::make($data['password']),
		            'is_parent' => $data['user-type'],
		        ]);
				  } catch (Exception $e){
				    $errorCode = $e->errorInfo[1];
				    if($errorCode == 1062){
				        $message = "Family Member already exists";

				        return view('add_user')->with('error', $message);
				    } else{
				    	$message = "Unknown Error";
				    	return view('add_user')->with('error', $message);
				    }
				  }

        //parent adding a parent
        }else if(isset($data['parent-email'])){

            
        	  try {
				    User::create([
		            'name' => $data['name'],
		            'family_id' => $data['parent-email'],
		            'email' => $data['email'],
		            'password' => Hash::make($data['password']),            
		        ]);
				  } catch (Exception $e){
				    $errorCode = $e->errorInfo[1];
				    if($errorCode == 1062){
				        $message = "Family Member already exists";

				        return view('add_user')->with('error', $message);
				    } else{
				    	$message = "Unknown Error";
				    	return view('add_user')->with('error', $message);
				    }
				  }


        } else{
            $message = "Unable to add family member";
            return view('home')->with('addError', $message);
        }

             
        $family= User::getFamily($user['family_id']);

    	$user['family']=$family;

    	\Session::put('user', $user); 	
    	\Session::save();

        $message = "Successfully added family member!";

        

        return view('home')->with('addSuccess', $message);


    }
    
}
