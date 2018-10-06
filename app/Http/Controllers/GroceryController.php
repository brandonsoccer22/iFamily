<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Grocery;
use App\User;
use Illuminate\Support\Facades\DB;

class GroceryController extends Controller
{
    public function index(Request $request){   	
    	$groceries = DB::table('groceries')
    	->SELECT('groceries.*', 'users.name AS username')
    	->join('users', 'users.id', '=', 'groceries.created_by')->get()->where('done_by', null);

    	$done_groceries = DB::table('groceries')
    	->SELECT('groceries.*', 'u1.name AS added_by', 'u2.name AS bought_by')
    	->join('users AS u1', 'u1.id', '=', 'groceries.created_by')
    	->join('users AS u2', 'u2.id', '=', 'groceries.done_by')
    	->whereNotNull('done_by')->get();
    	return view('groceries.index')->with(['groceries' => $groceries, 'done_groceries' => $done_groceries]);
    }
    public function create()
    {
    	return view('groceries.create');
    }
    public function store()
    {
        Grocery::create([
		            'name' => request('name'),
		            'description' => request('description'),
		            'type' => request('type'),
		            'from' => request('from'),
		            'created_by' => request('created_by'),
		        ]);

        $message="Grocery Added Successfully!";
    	return view('home')->with('addGrocerySuccess', $message);;
    }
    public function done()
    {
        DB::table('groceries')
        ->where('id', request('id'))
        ->update(['done_by' => request('done_by')]);

        $message="Grocery Marked as Done Successfully!";
    	return view('home')->with('addGrocerySuccess', $message);;
    }
    public function delete()
    {
        DB::table('groceries')
        ->where('id', request('id'))
        ->delete();

        $message="Grocery Marked as Done Successfully!";
    	return view('home')->with('addGrocerySuccess', $message);;
    }
}
