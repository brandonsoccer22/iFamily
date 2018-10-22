<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StatsController extends Controller
{
   /**
	*Return a page for the parent to review choirs
    */
    public function view(Request $request){
    	   	
    	
        $users = DB::table('users')
        ->SELECT('users.id', 'users.name', 'users.email', 'users.is_parent', 'users.is_admin')->get();
        return view('admin.stats')->with('users',$users);
    }

}