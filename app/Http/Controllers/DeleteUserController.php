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
        ->SELECT('users.id', 'users.name', 'users.email', 'users.is_parent', 'users.is_admin', 'users.family_id', 'users.is_hidden')
        ->where('users.is_hidden', false)
        ->ORDERBY('family_id')
        ->get();

        $hiddenusers = DB::table('users')
        ->SELECT('users.id', 'users.name', 'users.email', 'users.is_parent', 'users.is_admin', 'users.family_id', 'users.is_hidden')
        ->where('users.is_hidden', true)
        ->orderby('family_id')
        ->get();

        return view('admin.delete_user')->with(['users' => $users, 'hiddenusers' => $hiddenusers]);
    }

    
    public function delete()
    {
        DB::table('users')
        ->where('id', request('id'))
        ->update(['is_hidden' => true]);


        $users = DB::table('users')
        ->SELECT('users.id', 'users.name', 'users.email', 'users.is_parent', 'users.is_admin', 'users.family_id', 'users.is_hidden')
        ->where('users.is_hidden', false)
        ->ORDERBY('family_id')
        ->get();

        $hiddenusers = DB::table('users')
        ->SELECT('users.id', 'users.name', 'users.email', 'users.is_parent', 'users.is_admin', 'users.family_id', 'users.is_hidden')
        ->where('users.is_hidden', true)
        ->orderby('family_id')
        ->get();

        return view('admin.delete_user')->with(['users' => $users, 'hiddenusers' => $hiddenusers]);

    }

    public function deletefamily(){
        DB::table('users')
        ->where('family_id', request('id'))
        ->where('is_admin', false)
        ->update(['is_hidden' => true]);


        $users = DB::table('users')
        ->SELECT('users.id', 'users.name', 'users.email', 'users.is_parent', 'users.is_admin', 'users.family_id', 'users.is_hidden')
        ->where('users.is_hidden', false)
        ->ORDERBY('family_id')
        ->get();

        $hiddenusers = DB::table('users')
        ->SELECT('users.id', 'users.name', 'users.email', 'users.is_parent', 'users.is_admin', 'users.family_id', 'users.is_hidden')
        ->where('users.is_hidden', true)
        ->orderby('family_id')
        ->get();

        return view('admin.delete_user')->with(['users' => $users, 'hiddenusers' => $hiddenusers]);
    }
    
    public function recover(){
        DB::table('users')
        ->where('id', request('id'))
        ->update(['is_hidden' => false]);
        $users = DB::table('users')
        ->SELECT('users.id', 'users.name', 'users.email', 'users.is_parent', 'users.is_admin', 'users.family_id', 'users.is_hidden')
        ->where('users.is_hidden', false)
        ->ORDERBY('family_id')
        ->get();

        $hiddenusers = DB::table('users')
        ->SELECT('users.id', 'users.name', 'users.email', 'users.is_parent', 'users.is_admin', 'users.family_id', 'users.is_hidden')
        ->where('users.is_hidden', true)
        ->orderby('family_id')
        ->get();

        $message="User recovered successfully!";
        //return view('home')->with('del',$message);;
        return view('admin.delete_user')->with(['users' => $users, 'hiddenusers' => $hiddenusers]);
    }
}
