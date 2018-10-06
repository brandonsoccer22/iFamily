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
    	->SELECT('polls.*', 'users.name AS username', DB::raw('group_concat(distinct(pc.choice)) AS choices') , DB::raw('group_concat(pv.choice) AS votes'))
    	->join('users', 'users.id', '=', 'polls.created_by')
    	->join('poll_choices AS pc', 'pc.poll_id', '=', 'polls.id')
    	->leftjoin('poll_votes AS pv', function($join){
            $join->on("pv.poll_id","=","polls.id")
            ->on("pv.choice","=","pc.choice");
        })
    	->groupby('polls.id')
    	->get()->where('completed', '=','0');

        $closed_polls = DB::table('polls')
        ->SELECT('polls.*', 'users.name AS username', DB::raw('group_concat(distinct(pc.choice)) AS choices') , DB::raw('group_concat(pv.choice) AS votes'))
        ->join('users', 'users.id', '=', 'polls.created_by')
        ->join('poll_choices AS pc', 'pc.poll_id', '=', 'polls.id')
        ->leftjoin('poll_votes AS pv', function($join){
            $join->on("pv.poll_id","=","polls.id")
            ->on("pv.choice","=","pc.choice");
        })
        ->groupby('polls.id')
        ->get()->where('completed', '=','1');
    	return view('polls.index')->with(['polls' => $polls,'closed_polls' => $closed_polls]);
    }
    public function create()
    {
        return view('polls.create');
    }
    public function store()
    {
        $poll = Poll::create([
            'title' => request('title'),
            'created_by' => request('created_by'),
        ]);
        Poll:
        PollChoice::create([
            'poll_id' => $poll->id,
            'choice' => request('choice1'),
        ]);
        PollChoice::create([
            'poll_id' => $poll->id,
            'choice' => request('choice2'),
        ]);
        if(request('choice3') != '')
        {
            PollChoice::create([
                'poll_id' => $poll->id,
                'choice' => request('choice3'),
            ]);
        }
        if(request('choice4') != '')
        {
            PollChoice::create([
                'poll_id' => $poll->id,
                'choice' => request('choice4'),
            ]);
        }
        $message="Poll Created Successfully!";
        return view('home')->with('addPollSuccess', $message);;
    }
    public function done()
    {
        DB::table('polls')
        ->where('id', request('id'))
        ->update(['completed' => true]);

        $message="Poll Closed Successfully!";
        return view('home')->with('addPollSuccess', $message);
    }
    public function vote()
    {
        $first = PollVote::where([['user_id', request('user_id')],['poll_id', request('poll_id')]])->count() == 0;
        if($first)
        {
            PollVote::create([
                'poll_id' => request('poll_id'),
                'choice' => request('Poll'),
                'user_id' => request('user_id'),
            ]);
        }
        else
        {
            DB::table('poll_votes')
            ->where([['user_id', request('user_id')],['poll_id', request('poll_id')]])
            ->update(['choice' => request('Poll'), 'updated_at' => DB::raw('NOW()')]);
        }
        $message="Voted Successfully!";
        return view('home')->with('addPollSuccess', $message);
    }
}
