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
    	->join('users', 'users.id', '=', 'groceries.added_by')->get()->where('status', '=','0');
    	return view('groceries')->with('groceries', $groceries);
    }

}
