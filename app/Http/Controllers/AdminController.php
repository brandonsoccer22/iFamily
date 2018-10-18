<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Choir; 

class AdminController extends Controller
{
   /**
	*Return a page for the parent to review choirs
    */
    public function view(Request $request){
    	   	
    	
    	return view('admin');//->with('choirs',$choirs)->with('pendingChoirs',$pendingChoirs);;
    }

}