<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Poll;
use App\PollVote;
use App\PollChoice;
class PollController extends Controller
{
    public function index(Request $request){
    	   	
    	$polls= Poll::incomplete()->get();
    	return view('polls')->with('polls',$polls);
    }
}
