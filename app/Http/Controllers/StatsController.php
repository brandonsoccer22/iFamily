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
        ->SELECT('users.id', 'users.name', 'users.email', 'users.is_parent', 'users.is_admin', 'users.family_id')->get();

        $chores = DB::table('choirs')
        ->SELECT('choirs.id', 'choirs.user_id', 'choirs.created_by',
        'choirs.name', 'choirs.repeat', 'users1.name AS assignedto', 'users2.name AS createdby')
        ->join('users AS users1', 'users1.id', '=', 'choirs.user_id')
        ->join('users AS users2', 'users2.id', '=', 'choirs.created_by')
        ->get();

        $groceries = DB::table('groceries')
        ->SELECT('groceries.id', 'groceries.name', 'groceries.description',
        'groceries.from', 'groceries.type', 'groceries.created_by', 'groceries.done_by', 'users.name AS username')
        ->join('users', 'users.id', '=', 'groceries.created_by')->get();

        $polls = DB::table('polls')
        ->SELECT('polls.id', 'polls.title', 'polls.created_by', 'polls.completed', 'users.name AS username')
        ->join('users', 'users.id', '=', 'polls.created_by') ->get();

        return view('admin.stats')->with(['users'=>$users, 'chores'=>$chores, 'groceries'=>$groceries, 'polls'=>$polls]);
    }

}

