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

    	return view('add_user')->with('user',$user);
    }


    //set the current value of the user
    public function setUser(Request $request){

    	$user = $request->user();    	

    	return view('home')->with('user',$user);
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
		            'is_parrent' => $data['user-type'],
		        ]);
				  } catch (Exception $e){
				    $errorCode = $e->errorInfo[1];
				    if($errorCode == 1062){
				        $message = "Family Member already exists";

				        return view('add_user')->with('error', $message)->with('user',$user);
				    } else{
				    	$message = "Unknown Error";
				    	return view('add_user')->with('error', $message)->with('user',$user);
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

				        return view('add_user')->with('error', $message)->with('user',$user);
				    } else{
				    	$message = "Unknown Error";
				    	return view('add_user')->with('error', $message)->with('user',$user);
				    }
				  }


        } else{
            $message = "Unable to add family member";
            return view('home')->with('addError', $message)->with('user',$user);
        }

             


        $message = "Successfully added family member!";

        

        return view('home')->with('addSuccess', $message)->with('user',$user);


    }
    
}
