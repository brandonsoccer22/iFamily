<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Grocery;
class GroceryController extends Controller
{
    public function index(Request $request){
    	   	
    	$groceries= Grocery::undone()->get();
    	return view('groceries')->with('groceries',$groceries);
    }
}
