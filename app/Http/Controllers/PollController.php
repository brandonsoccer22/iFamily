<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Poll;
use App\PollVote;
use App\PollChoice;
use Illuminate\Support\Facades\DB;

class PollController extends Controller
{
    public function index(Request $request){
    	$polls = DB::table('polls')
    	->SELECT('polls.*', 'users.name AS username', DB::raw('group_concat(distinct(pc.choice_id)) AS choices') , DB::raw('group_concat(pv.choice_id) AS votes'))
    	->join('users', 'users.id', '=', 'polls.user_id')
    	->join('poll_choices AS pc', 'pc.poll_id', '=', 'polls.id')
    	->leftjoin('poll_votes AS pv', function($join){
                $join->on("pv.poll_id","=","polls.id")
                    ->on("pv.choice_id","=","pc.choice_id");
            })
    	->groupby('polls.id')
    	->get()->where('completed', '=','0');
    	return view('polls')->with('polls', $polls);
    }
}
