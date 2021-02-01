<?php

namespace App\Http\Controllers;
use Image;
use Illuminate\Support\Str;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Contest;
use App\Game;
use App\ContestSubscription;
use Illuminate\Http\Request;

class ContestController extends Controller
{
    public function contestPage(){
        // $contests = Contest::orderBy('id','desc')->paginate(15);
        $contests = DB::table('contests')
                        ->join('games','games.id','=','contests.game_id')
                        ->select('contests.*','games.game_name')
                        ->orderBy('id','desc')
                        ->paginate(15);

        $games = Game::all();
        return view('backend.contest',compact('contests','games'));
    }

    public function addNewContest(Request $request){

        Contest::insert([
            'game_id' => $request->game_id,
            'game_code' => $request->game_code,
            'title' => $request->title,
            'date' => $request->date,
            'time' => date("g:i A", strtotime($request->time)),
            'amount' => $request->amount,
            'first' => $request->first,
            'second' => $request->second,
            'third' => $request->third,
            'participants' => $request->participants,
            'created_at' => Carbon::now()
        ]);

        Toastr::success('Contest has been Added', 'Success');
        return back();
    }

    public function deleteContest($id){
        Contest::where('id',$id)->delete();
        Toastr::error('Contest has been Deleted', 'Deleted');
        return back();
    }

    public function viewContestSubscribers(){
        $contest_subscribers = DB::table('contest_subscriptions')
                ->join('contests','contests.id','=','contest_subscriptions.contest_id')
                ->join('games','games.id','=','contests.game_id')
                ->join('users','users.id','=','contest_subscriptions.user_id')
                ->select('contest_subscriptions.*','contests.title as contest_title','users.name as user_name','users.email','games.game_name')
                ->orderBy('contest_id','desc')
                ->paginate(15);

        return view('backend.contest_subcribers',compact('contest_subscribers'));
    }

    public function deleteContestSubscriber($id){
        ContestSubscription::where('id',$id)->delete();
        Toastr::error('Contest Subscriber has been Deleted', 'Deleted');
        return back();
    }

    public function approveContestSubscriber($id){
        ContestSubscription::where('id',$id)->update([
            'status' => 1,
            'updated_at' => Carbon::now()
        ]);
        Toastr::success('Contest Subscriber has been Approved', 'Approved');
        return back();
    }

    public function denyContestSubscriber($id){
        ContestSubscription::where('id',$id)->update([
            'status' => 2,
            'updated_at' => Carbon::now()
        ]);
        Toastr::warning('Contest Subscriber has been Denied', 'Denied');
        return back();
    }
}
