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
    	return view('review_choirs')->with('choirs',$choirs);
    }

    public function put(Request $request){

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


    	$message="Choir Added Successfully!";

    	return view('home')->with('addChoirSuccess', $message);;
    }
}
