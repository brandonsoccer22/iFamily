<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\DB;

class DeleteUserController extends Controller
{
   /**
	*Return a page for the parent to review choirs
    */
    public function view(Request $request){

        $users = DB::table('users')
        ->SELECT('users.id', 'users.name', 'users.email', 'users.is_parent', 'users.is_admin')->get();
        return view('admin.delete_user')->with('users',$users);
    }

    
    public function delete()
    {
        DB::table('users')
        ->where('id', request('id'))
        ->delete();

        $message="User deleted successfully!";
    	return view('home')->with('del',$message);;

    }

}
