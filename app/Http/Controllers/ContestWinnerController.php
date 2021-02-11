<?php

namespace App\Http\Controllers;
use App\ContestWinner;
use App\Contest;
use App\Game;
use App\User;
use Carbon\Carbon;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ContestWinnerController extends Controller
{
    public function contestWinnerPage(){
        $contest_winner = DB::table('contest_winners')
                            ->join('contests','contests.id','=','contest_winners.contest_id')
                            ->join('games','games.id','=','contest_winners.game_id')
                            ->join('users','users.id','=','contest_winners.user_id')
                            ->select('contest_winners.*','contests.title','games.game_name','users.name as user_name','users.image as user_image')
                            ->orderBy('contest_winners.contest_id','desc')
                            ->paginate(15);

        $games = Game::all();
        $users = User::all();
        return view('backend.contest_winner',compact('contest_winner','games','users'));
    }

    public function findContestSubscriberByContest($id){
        $contest_subscribers = DB::table('contest_subscriptions')
                                ->join('users','users.id','=','contest_subscriptions.user_id')
                                ->select('contest_subscriptions.*','users.name','users.email','users.phone')
                                ->where('contest_subscriptions.contest_id',$id)
                                ->get();
        $str = "<tr>";
        if(count($contest_subscribers) > 0){
            $sl = 1;
            foreach($contest_subscribers as $item){
                $str = "<input type='hidden' name='user_id[]' value='".$item->user_id."'>
                        <td style='width: 5%'>".$sl++."</td>
                        <td style='width: 20%'>".$item->name."</td>
                        <td style='width: 20%'>".$item->email."</td>
                        <td style='width: 15%'>".$item->phone."</td>
                        <td style='width: 20%'><select name='position[]'><option value='0'>Select One</option><option value='1'>1st</option><option value='2'>2nd</option><option value='3'>3rd</option></select></td>
                        <td style='width: 20%'><input type='text' name='kill[]' placeholder='No. of Kills' style='width: 90%' value=''></td>";
            }
        }
        else{
            $str = "<td>No Contest Subscriber Found</td>";
        }
        $str .= "</tr>";

        return response()->json($str);
    }

    public function searchCustomerForNewSale(Request $request){
        if($request->ajax()) {

            if($request->country == ""){
                $output = '';
                return $output;
            }
            else{
                $data = DB::table('users')->where('phone','LIKE',$request->country."%")->get();
                $output = '';
                if (count($data)>0) {
                    $output = '<ul class="list-group" style="display: block; position: absolute; bottom:38px; z-index: 1;">';
                    foreach ($data as $row){
                        $output .= '<li class="list-group-item" style="background:#28a745;color:ghostwhite;padding-top:3px;padding-bottom: 3px;cursor:pointer ">'.$row->name."-".$row->phone.'</li>';
                    }
                    $output .= '</ul>';
                }
                else {
                    $output .= null;
                }
                return $output;
            }
        }
    }

    public function customerIDfromName(Request $request){
        $data = array();
        $data = explode("-",$request->country);
        if($request->ajax()) {
            $data = DB::table('users')->where('phone',$data[1])->first();
            $output = '';
            $output = '<input type="hidden" id="get_that_value" name="user_id" value="'.$data->id.'">';
            return $output;
        }
    }

    public function addNewContestWinner(Request $request){

        $contest_info = Contest::where('id',$request->contest_id)->first();

        $i = 0;
        $amount = 0;
        $position = 0;
        foreach($request->user_id as $user_id){
            if($request->position[$i] > 0){
                if($request->position[$i] == 1){
                    $amount = $contest_info->first+($request->per_kill_amount*$request->kill[$i]);
                }
                if($request->position[$i] == 2){
                    $amount = $contest_info->second+($request->per_kill_amount*$request->kill[$i]);
                }
                if($request->position[$i] == 3){
                    $amount = $contest_info->third+($request->per_kill_amount*$request->kill[$i]);
                }

                ContestWinner::insert([
                    'user_id' => $user_id,
                    'contest_id' => $request->contest_id,
                    'game_id' => $request->game_id,
                    'position' => $request->position[$i],
                    'winning_amount' => $amount,
                    'kill' => $request->kill[$i],
                    'created_at' => Carbon::now()
                ]);
                User::where('id',$request->user_id)->increment('winning_amount',$amount);
                $i++;
            }
        }

        // if(ContestWinner::where('contest_id',$request->contest_id)->count() == 3){
        //     Contest::where('id',$request->contest_id)->update([
        //         'status' => 0,
        //     ]);
        // }

        Toastr::success('Contest Winner Added', 'Success');
        return back();
    }

    public function findContest($game_id){
        $contests = Contest::where('game_id',$game_id)->get();
        return response()->json($contests);
    }

    public function deleteContestWinner($id,$contest_id){
        $data = ContestWinner::where('id',$id)->first();
        User::where('id',$data->user_id)->decrement('amount', $data->winning_amount);
        ContestWinner::where('id',$id)->delete();
        if(ContestWinner::where('contest_id',$contest_id)->count() < 3){
            Contest::where('id',$contest_id)->update([
                'status' => 1,
            ]);
        }
        Toastr::error('Contest Winner has been Deleted', 'Deleted');
        return back();
    }
}
