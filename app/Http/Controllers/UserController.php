<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;
use Exception;
//use Auth;
//use App\Http\Controllers\Auth\LoginController;

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

    public function editPage(Request $request){
        $user = $request->user();       

        return view('edit_profile');
    }

    public function patch(Request $request){
        $data=$request->all(); 
        $user = $request->user();      

        $message="";

         try {
                   User::where('id',$data['id'])->update([                    
                    'name' => $data['name'],
                    'email' => $data['email'],                    
                ]);
          } catch (Exception $e){
            $errorCode = $e->errorInfo[1];
            if($errorCode == 1062){
                $message = "Email is already taken";

                return view('edit_profile')->with('error', $message);
            } else{
                $message = "Unknown Error";
                return view('edit_profile')->with('error', $message);
            }
          }        

        $user['name']=$data['name'];
        $user['email']=$data['email'];


        \Session::put('user', $user);   
        \Session::save();

        $message="Profile Updated Successfully!";
        return view('edit_profile')->with('success', $message);

    }


    //set the current value of the user
    public function setUser(Request $request){

    	$user = $request->user(); 

    	$family= User::getFamily($user['family_id']);

		$user['family']=$family;
		if($user['is_hidden'] == true){

			//Auth::logout();
			//\Session::flush();
			//return view('home')->with('addError','You are deleted');
			return redirect('/logout?state=deleted');
		}

    	\Session::put('user', $user); 	
    	\Session::save();

    	return view('home');
    }

    public function addUser(Request $request){
        //parent adding a kid
        $user = $request->user();    	
       

        $data=array();

		$data=$request->all();
		

        //\Log::info("in addUser, data=");
        //\Log::info(print_r($data,true));


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
