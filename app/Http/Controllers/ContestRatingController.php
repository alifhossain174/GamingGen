<?php

namespace App\Http\Controllers;

use App\ContestRating;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class ContestRatingController extends Controller
{
    public function contestRatingPage(){
        $contest_ratings = DB::table('contest_ratings')
                                ->join('contests','contests.id','=','contest_ratings.contest_id')
                                ->join('users','users.id','=','contest_ratings.user_id')
                                ->select('contest_ratings.*','contests.title','users.name as user_name')
                                ->paginate(15);

        return view('backend.contest_rating',compact('contest_ratings'));
    }

    public function deleteContestRating($id){
        ContestRating::where('id',$id)->delete();
        Toastr::error('Contest Rating has been Deleted', 'Deleted');
        return back();
    }
}
