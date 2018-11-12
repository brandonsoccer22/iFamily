<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Choir; 

class ChoirController extends Controller
{
   /**
	*Return a page for the parent to review choirs
    */
    public function index(Request $request){
    	   	
    	$choirs= Choir::get();
    	$pendingChoirs= Choir::getPending();
    	return view('review_choirs')->with('choirs',$choirs)->with('pendingChoirs',$pendingChoirs);
    }

    /**
	*Return a page for the kid/parent to view choirs (read-only)
    */
    public function view(Request $request){
    	$user_id=\Session::get('user')['id'];

    	//\Log::info("My user=".print_r(\Session::get('user'),true));

    	//\Log::info("My user_id=".$user_id);

    	$choirs= Choir::getMyChoirs($user_id);

    	\Log::info("My choir".print_r($choirs,true));

    	return view('view_choirs')->with('choirs',$choirs);
    }

     public function get(Request $request){
    	$data=$request->all(); 

    	$choir= Choir::getChoir($data['id']);

    	//\Log::info("Choir=".print_r($choir,true));

    	if(isset($data['status']) && $data['status']=="rejected"){
    		$choir['status']=$data['status'];
    	}   	
    	
    	//\Log::info(print_r($choir,true));
    	return view('components.choirs-edit-submit')->with('choir',$choir);
    }

    public function put(Request $request){

    	$data=$request->all();

    	switch($data['is_static']){

    		case 'none':
                if($data['duedate']){
        			$data['repeat']=$data['duedate'];
        			$data['is_static']=false;
                } else{
                    $data['repeat']='NA';
                    $data['is_static']=false;
                }
    			break;

			case 'daily':
				$data['repeat']='daily';
				$data['is_static']=true;
				break;

			case 'weekly':
				$data['repeat']='weekly';
				$data['is_static']=true;
				break;

			case 'monthly':
				$data['repeat']='monthly';
				$data['is_static']=true;
				break;

    	}

    	if(!isset($data['status'])){

    	Choir::create([
		            'name' => $data['name'],
		            'user_id' => $data['user_id'],
		            'created_by' => $data['created_by'],
		            'repeat' => $data['repeat'],
		            'note' => $data['note'],		            
		            'is_static' => $data['is_static'],
		        ]);
    				//user_name
    				//created_by_name
    	} else{
    		Choir::create([
		            'name' => $data['name'],
		            'user_id' => $data['user_id'],
		            'created_by' => $data['created_by'],
		            'repeat' => $data['repeat'],
		            'note' => $data['note'],		            
		            'is_static' => $data['is_static'],
		            'status' => $data['status'],
		        ]);
    	}

    	$message="Chore Added Successfully!";

    	return view('home')->with('addChoirSuccess', $message);
    }

    public function patch(Request $request){

    	$data=$request->all();

    	switch($data['is_static']){

    		case 'none':
    			$data['repeat']=$data['duedate'];
    			$data['is_static']=false;
    			break;

			case 'daily':
				$data['repeat']='daily';
				$data['is_static']=true;
				break;

			case 'weekly':
				$data['repeat']='weekly';
				$data['is_static']=true;
				break;

			case 'monthly':
				$data['repeat']='monthly';
				$data['is_static']=true;
				break;

    	}

    	$message="";

    	if(!isset($data['status'])){

    	Choir::where('id',$data['id'])->update([		            
		            'name' => $data['name'],
		            'user_id' => $data['user_id'],
		            'created_by' => $data['created_by'],
		            'repeat' => $data['repeat'],
		            'note' => $data['note'],		            
		            'is_static' => $data['is_static'],
		        ]);
    				//user_name
    				//created_by_name
    	$message="Chore Editted Successfully!";

    	} else{
    		Choir::where('id',$data['id'])->update([		            
		            'name' => $data['name'],
		            'user_id' => $data['user_id'],
		            'created_by' => $data['created_by'],
		            'repeat' => $data['repeat'],
		            'note' => $data['note'],		            
		            'is_static' => $data['is_static'],
		            'status' => $data['status'],
		        ]);
    		$message="Chore Status updated to ".$data['status'];
    	}

    	

    	return view('home')->with('addChoirSuccess', $message);
    }

    public function delete(Request $request){

    	$data=$request->all();
    	

    	Choir::where('id',$data['id'])->update([  
		            'status' => 'deleted',		            
		        ]);
    				//user_name
    				//created_by_name


    	

    	$message="Chore Deleted Successfully!";

    	if(isset($data['status']) && $data['status']=="approved"){
    		$message="Chore Approved Successfully!";
    	}

    	return view('home')->with('addChoirSuccess', $message);
    }

    public function submit(Request $request){

    	$data=$request->all();
    	

    	Choir::where('id',$data['id'])->update([  
		            'status' => 'pending',		            
		        ]);
    				//user_name
    				//created_by_name


    	$message="Chore Submitted Successfully!";

    	return view('home')->with('addChoirSuccess', $message);
    }   


    
}
