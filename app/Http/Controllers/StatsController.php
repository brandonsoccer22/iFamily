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
        $chores_active = DB::table('choirs')
        ->SELECT('choirs.id', 'choirs.user_id', 'choirs.created_by', 'choirs.status',
        'choirs.name', 'choirs.repeat', 'users1.name AS assignedto', 'users2.name AS createdby')
        ->join('users AS users1', 'users1.id', '=', 'choirs.user_id')
        ->join('users AS users2', 'users2.id', '=', 'choirs.created_by')
        ->where('choirs.status', 'open')
        ->get();

        $groceries_active = DB::table('groceries')
        ->SELECT('groceries.id', 'groceries.name', 'groceries.description', 'groceries.done_by',
        'groceries.from', 'groceries.type', 'groceries.created_by', 'groceries.done_by', 'users.name AS username')
        ->join('users', 'users.id', '=', 'groceries.created_by')
        ->where('groceries.done_by', null)
        ->get();

        $polls_active = DB::table('polls')
        ->SELECT('polls.id', 'polls.title', 'polls.created_by', 'polls.completed', 'users.name AS username')
        ->join('users', 'users.id', '=', 'polls.created_by')
        ->where('polls.completed', '0')
        ->get();


        $chores_history = DB::table('choirs')
        ->SELECT('choirs.id', 'choirs.user_id', 'choirs.created_by', 'choirs.status',
        'choirs.name', 'choirs.repeat', 'users1.name AS assignedto', 'users2.name AS createdby')
        ->join('users AS users1', 'users1.id', '=', 'choirs.user_id')
        ->join('users AS users2', 'users2.id', '=', 'choirs.created_by')
        ->where('choirs.status', 'deleted')
        ->get();

        $groceries_history = DB::table('groceries')
        ->SELECT('groceries.id', 'groceries.name', 'groceries.description', 'groceries.done_by',
        'groceries.from', 'groceries.type', 'groceries.created_by', 'groceries.done_by', 'users.name AS username')
        ->join('users', 'users.id', '=', 'groceries.created_by')
        ->whereNotNull('groceries.done_by')
        ->get();

        $polls_history = DB::table('polls')
        ->SELECT('polls.id', 'polls.title', 'polls.created_by', 'polls.completed', 'users.name AS username')
        ->join('users', 'users.id', '=', 'polls.created_by')
        ->where('polls.completed', '=', '1')
        ->get();

        return view('admin.stats')->with
        (['chores_active'=>$chores_active, 'groceries_active'=>$groceries_active, 'polls_active'=>$polls_active,
        'chores_history'=>$chores_history, 'groceries_history'=>$groceries_history, 'polls_history'=>$polls_history]);
    }

}

