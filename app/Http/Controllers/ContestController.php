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
        $games = Game::all();
        return view('backend.contest',compact('games'));
    }

    public function viewAllContests(){
        $contests = DB::table('contests')
                        ->join('games','games.id','=','contests.game_id')
                        ->select('contests.*','games.game_name')
                        ->orderBy('id','desc')
                        ->paginate(15);

        return view('backend.view_contests',compact('contests'));
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
            'joining_link' => $request->joining_link,
            'room_no' => $request->room_no,
            'description' => $request->description,
            'created_at' => Carbon::now()
        ]);

        Toastr::success('Contest has been Added', 'Success');
        return back();
    }

    public function getDataForModal($id){
        $product = Contest::where('id',$id)->first();
        $games = Game::all();

        $select_options = "<select name='game_id' class='form-control' required><option value=''>Select Option</option>";
            foreach($games as $item){
                if($item->id == $product->game_id){
                    $select_options .= "<option value='".$item->id."' selected>".$item->game_name."</option>";
                }
                else{
                    $select_options .= "<option value='".$item->id."'>".$item->game_name."</option>";
                }

            }
        $select_options .= "</select>";

        return response()->json([
            'data' => $product,
            'select_options' => $select_options
        ]);
    }

    public function updateContestData(Request $request){
        Contest::where('id',$request->contest_id)->update([
            'game_id' => $request->game_id,
            'game_code' => $request->game_code,
            'title' => $request->title,
            'date' => $request->date,
            'time' => $request->time,
            'amount' => $request->amount,
            'first' => $request->first,
            'second' => $request->second,
            'third' => $request->third,
            'participants' => $request->participants,
            'joining_link' => $request->joining_link,
            'room_no' => $request->room_no,
            'description' => $request->description,
            'updated_at' => Carbon::now()
        ]);
        return response()->json(['success'=>'Data saved successfully.']);
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
                ->select('contest_subscriptions.*','contests.title as contest_title','users.name as user_name','games.game_name')
                ->orderBy('contest_id','desc')
                ->paginate(15);

        return view('backend.contest_subcribers',compact('contest_subscribers'));
    }

    public function filterByContest(Request $request){

        if($request->contest_id == 0){
            $contest_subscribers = DB::table('contest_subscriptions')
                ->join('contests','contests.id','=','contest_subscriptions.contest_id')
                ->join('games','games.id','=','contests.game_id')
                ->join('users','users.id','=','contest_subscriptions.user_id')
                ->select('contest_subscriptions.*','contests.title as contest_title','users.name as user_name','games.game_name')
                ->orderBy('contest_id','desc')
                ->paginate(15);

            return view('backend.contest_subcribers',compact('contest_subscribers'));
        }
        else{
            $contest_subscribers = DB::table('contest_subscriptions')
                    ->join('contests','contests.id','=','contest_subscriptions.contest_id')
                    ->join('games','games.id','=','contests.game_id')
                    ->join('users','users.id','=','contest_subscriptions.user_id')
                    ->select('contest_subscriptions.*','contests.title as contest_title','users.name as user_name','games.game_name')
                    ->where('contests.id',$request->contest_id)
                    ->orderBy('contest_id','desc')
                    ->paginate(15);

            return view('backend.contest_subcribers',compact('contest_subscribers'));
        }
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

    public function closeContest($id){
        Contest::where('id',$id)->update([
            'close' => 1,
        ]);
        Toastr::error('Contest has been Closed', 'Closed');
        return back();
    }

    public function openContest($id){
        Contest::where('id',$id)->update([
            'close' => 0,
        ]);
        Toastr::success('Contest has been Opened', 'Closed');
        return back();
    }

    public function endContest($id){
        Contest::where('id',$id)->update([
            'status' => 0,
        ]);
        Toastr::error('Contest has been End', 'Closed');
        return back();
    }
}
