<?php

namespace App\Http\Controllers;

use App\User;
use Image;
use App\Slider;
use App\Game;
use App\WithDraw;
use App\AddMoney;
use App\Payment;
use App\Package;
use App\PackageRequest;
use App\Contest;
use App\ContestWinner;
use App\ContestRating;
use Carbon\Carbon;
use App\Trend;



class MainController extends Controller
{
         public function newAmount(Request $request){
        $user_info = User::where('id',$request->user_id)->first();
        if($user_info->winning_amount <= $request->amount){
            return response()->json([
                'success'=> false,
                'message'=> 'Sorry! Dont have enough winning amount'
            ]);
        }
        else{

            $winning = $user_info->winning_amount - $request->amount;
            $amnt = $user_info->amount + $winning;

              return response()->json([
                'success'=> true,
                'message'=> 'Amount Conversion Successfull!',
                'amnt'=> $amnt,
                'winning'=> $winning,
            ]);
        }
    }
    
        public function getSliders(){
        $data = Slider::all();
        return response()->json([
            'success'=> true,
            'data'=> $data,
        ]);
    }
}
