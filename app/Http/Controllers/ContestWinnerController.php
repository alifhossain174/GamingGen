<?php

namespace App\Http\Controllers;
use App\ContestWinner;
use App\Contest;
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

        $contests = Contest::where('status',1)->get();
        return view('backend.contest_winner',compact('contest_winner','contests'));
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

        if($request->position == 1){
            $amount = $contest_info->first;
        }
        elseif($request->position == 2){
            $amount = $contest_info->second;
        }
        else{
            $amount = $contest_info->third;
        }

        if(ContestWinner::where('user_id',$request->user_id)->where('contest_id',$request->contest_id)->where('position',$request->position)->exists()){
            Toastr::warning('Alread a Winner', 'Success');
            return back();
        }
        else{
            ContestWinner::insert([
                'user_id' => $request->user_id,
                'contest_id' => $request->contest_id,
                'game_id' => $contest_info->game_id,
                'position' => $request->position,
                'winning_amount' => $amount,
                'created_at' => Carbon::now()
            ]);

            User::where('id',$request->user_id)->increment('amount',$amount);

            if(ContestWinner::where('contest_id',$request->contest_id)->count() == 3){
                Contest::where('id',$request->contest_id)->update([
                    'status' => 0,
                ]);
            }

        }
        Toastr::success('Contest Winner Added', 'Success');
        return back();
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
