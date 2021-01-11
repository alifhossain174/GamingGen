<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\User;
use Image;
use App\Slider;
use App\Game;
use App\WithDraw;
use App\AddMoney;
use App\Package;
use App\PackageRequest;
use App\Contest;
use App\ContestWinner;
use App\ContestRating;
use Carbon\Carbon;
use App\Trend;
use App\ContestSubscription;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class ApiController extends Controller
{
    public function userLogin(Request $request){

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password]) || Auth::attempt(['phone' => $request->email, 'password' => $request->password])) {
            $id=Auth::user()->id;
            $name=Auth::user()->name;
            $email=Auth::user()->email;
            $phone=Auth::user()->phone;
            $referral_code = Auth::user()->referral_code;
            $amount = Auth::user()->amount;
            $image = Auth::user()->image;
            $department = Auth::user()->department;
            $semester = Auth::user()->semester;
            $profession = Auth::user()->profession;
            $details = Auth::user()->details;

            $data=array('id'=>$id,'name'=>$name,'email'=>$email,'referral_code' => $referral_code, 'amount' => $amount, 'phone' => $phone, 'image' => $image, 'department' => $department, 'semester' => $semester, 'profession' => $profession, 'details' => $details);
            return response()->json(['success' =>true,'data'=>$data]);
        }
        else{
            return response()->json([
                'success' => false,
                'message' => 'Invalid Login Credential'
            ])->setStatusCode(200);
        }
    }


    public function userRegistration(Request $request){

        $data = array();
        $data['email'] = $request->email;
        $data['password'] = Hash::make($request->password);
        $data['name'] = $request->name;
        $data['referral_code'] = $request->referral_code;
        $data['phone'] = $request->phone;

        $email_check = User::where('email',$request->email)->first();
        $phone_check = User::where('phone',$request->phone)->first();

        if($email_check){
            return response()->json([
                'success'=> false,
                'message'=> 'Email already used. Please add another Email.'
            ]);
        }
        elseif($phone_check){
            return response()->json([
                'success'=> false,
                'message'=> 'Contact Number already used. Please add another Number.'
            ]);
        }
        else{

            $data['amount'] = 0;
            if(User::where('referral_code',$data['referral_code'])->exists()){
                $user_lists = User::where('referral_code',$data['referral_code'])->get();
                foreach($user_lists as $item){
                    $info = User::where('id',$item->id)->first();
                    User::where('id',$item->id)->update([
                        'amount' => $info->amount+5
                    ]);
                }
                $data['amount'] = 5;
            }


            $data['referral_code'] = str::random(5) . time();

            $id = DB::table('users')->insertGetId($data);
            $user_details = DB::table('users')->select('id','name','email','referral_code','amount','phone','image','department','semester')->where('id',$id)->first();
            return response()->json([
                'success'=> true,
                'data'=> $user_details,
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

    public function getGames(){
        $data = Game::all();
        return response()->json([
            'success'=> true,
            'data'=> $data,
        ]);
    }

    public function getTrends(){
        $trends = DB::table('trends')
                    ->join('games','games.id','=','trends.game_id')
                    ->select('trends.*','games.game_name','games.package_name')
                    ->paginate(15);

        return response()->json([
            'success'=> true,
            'data'=> $trends,
        ]);
    }

    public function getContests(Request $request){
        $lists = Contest::where('status',1)->where('game_id',$request->game_id)->get();
        $data = array();
        foreach($lists as $list){
            $info = DB::table('contests')
                        ->join('games','games.id','=','contests.game_id')
                        ->select('contests.*','games.game_name','games.package_name')
                        ->where('contests.id',$list->id)
                        ->first();

            if(DB::table('contest_subscriptions')->where('contest_id',$list->id)->where('user_id',$request->user_id)->exists()){
                $data[] = array('id' => $info->id, 'game_id' => $list->game_id, 'game_code' => $list->game_code, 'package_name' => $info->package_name, 'title' => $info->title, 'date' => $info->date, 'time' => $info->time, 'status' => $info->status, 'amount' => $info->amount, 'first' => $list->first, 'second' => $list->second, 'third' => $list->third, 'subscribed' => 1);
            }
            else{
                $data[] = array('id' => $info->id, 'game_id' => $list->game_id, 'game_code' => $list->game_code, 'package_name' => $info->package_name, 'title' => $info->title, 'date' => $info->date, 'time' => $info->time, 'status' => $info->status, 'amount' => $info->amount, 'first' => $list->first, 'second' => $list->second, 'third' => $list->third, 'subscribed' => 0);
            }
        }
        return response()->json([
            'success'=> true,
            'data'=> $data,
        ]);
    }

    public function subscribeContest(Request $request){
        $user_info = User::where('id',$request->user_id)->first();
        $info = Contest::where('id',$request->contest_id)->first();

        $already_subscribed_participants = ContestSubscription::where('contest_id',$request->contest_id)->where('status',1)->count();

        if($user_info->amount >= $info->amount){
            if($already_subscribed_participants > $info->participants){
                return response()->json([
                    'success'=> false,
                    'message'=> 'Slot is fullfilled Already'
                ]);
            }
            else{
                ContestSubscription::insert([
                    'user_id' => $request->user_id,
                    'contest_id' => $request->contest_id,
                    'date' => $info->date,
                    'time' => $info->time,
                    'amount' => $info->amount,
                    'created_at' => Carbon::now()
                ]);
                $remaining_amount = $user_info->amount - $info->amount;
                User::where('id',$request->user_id)->update([
                    'amount' => $remaining_amount,
                    'updated_at' => Carbon::now()
                ]);
                return response()->json([
                    'success'=> true,
                    'message'=> 'Successfully Subscribed'
                ]);
            }
        }
        else{
            return response()->json([
                'success'=> false,
                'message'=> 'Sorry! Dont have enough amount to subscribe the contest'
            ]);
        }
    }

    public function winningContestLists(Request $request){
        $data = DB::table('contest_winners')
                        ->join('contests','contests.id','=','contest_winners.contest_id')
                        ->join('games','games.id','=','contest_winners.game_id')
                        ->join('users','users.id','=','contest_winners.user_id')
                        ->select('contests.title as contest_name','games.game_name', 'games.logo', 'users.name as user_name','contest_winners.position','contest_winners.winning_amount')
                        ->where('user_id',$request->user_id)
                        ->orderBy('contest_winners.contest_id','desc')
                        ->paginate(15);

        return response()->json([
            'success'=> true,
            'data'=> $data,
        ]);
    }

    public function viewLeaderBoard(Request $request){

        $data = DB::select("SELECT user_id as uid,(SELECT sum(winning_amount) as amount FROM contest_winners WHERE game_id = '$request->game_id' AND user_id = uid) as amount, users.image, users.name as user_name FROM contest_winners INNER JOIN users ON contest_winners.user_id=users.id WHERE game_id = '$request->game_id' Group By uid Order By amount DESC LIMIT 20");

        return response()->json([
            'success'=> true,
            'data'=> $data,
        ]);

    }

    public function withDrawAmount(Request $request){
        $user_info = User::where('id',$request->user_id)->first();
        if($user_info->amount < $request->amount){
            return response()->json([
                'success'=> false,
                'message'=> 'Sorry! Dont have enough amount to withdraw'
            ]);
        }
        else{
            WithDraw::insert([
                'user_id' => $request->user_id,
                'phone' => $request->phone,
                'payment_method' => $request->payment_method,
                'amount' => $request->amount,
                'refference_no' => $request->refference_no,
                'created_at' => Carbon::now()
            ]);
            User::where('id',$request->user_id)->decrement('amount',$request->amount);
            return response()->json([
                'success'=> true,
                'message'=> 'Amount Withdraw request has been sent'
            ]);
        }
    }

    public function withDrawAmountHistory(Request $request){
        $withdraw_history = WithDraw::where('user_id',$request->user_id)->get();
        return response()->json([
            'success'=> true,
            'data'=> $withdraw_history,
        ]);
    }

    public function addMoney(Request $request){
        AddMoney::insert([
            'user_id' => $request->user_id,
            'phone' => $request->phone,
            'payment_method' => $request->payment_method,
            'amount' => $request->amount,
            'refference_no' => $request->refference_no,
            'transaction_id' => $request->transaction_id,
            'created_at' => Carbon::now()
        ]);
        return response()->json([
            'success'=> true,
            'message'=> 'Add Money Request has been sent'
        ]);
    }

    public function addMoneyHistory(Request $request){
        $add_money_history = AddMoney::where('user_id',$request->user_id)->get();
        return response()->json([
            'success'=> true,
            'data'=> $add_money_history,
        ]);
    }

    public function userInfoUpdate(Request $request){
        User::where('id',$request->user_id)->update([
            'name' => $request->name,
            'department' => $request->department,
            'semester' => $request->semester,
            'profession' => $request->profession,
            'details' => $request->details,
        ]);
        return response()->json([
            'success'=> true,
            'message'=> 'User Info Updated'
        ]);
    }

    public function changePassword(Request $request){
        $user_info = User::where('id',$request->user_id)->first();
        User::where('id',$request->user_id)->update([
            'password' => Hash::make($request->new_password)
        ]);
        return response()->json([
            'success'=> true,
            'message'=> 'Password has been changed'
        ]);
    }

    public function profileImageUpload(Request $request){
        $image = null;
        if ($request->hasFile('image')){
            $user_info = User::where('id',$request->user_id)->first();
            if($user_info->image != null){
                if(file_exists(public_path($user_info->image))){
                    unlink($user_info->image);
                }
            }
            $get_image = $request->file('image');
            $image_name = str::random(5) . time() . '.' . $get_image->getClientOriginalExtension();
            Image::make($get_image)->save('profile_images/' . $image_name, 50);
            $image = "profile_images/" . $image_name;
        }
        User::where('id',$request->user_id)->update([
            'image' => $image,
        ]);
        return response()->json([
            'success'=> true,
            'data'=> $image
        ]);
    }

    public function forgetPassword(Request $request){
        $pass = str::random(5).time();
        $msg = "Your password is: ".$pass;
        $msg = wordwrap($msg,70);

        try {
            if(!mail($request->email,"Gaming Gen Password",$msg)) {
                throw new customException($email);
            }
            else{
                mail($request->email,"Gaming Gen Password",$msg);
                User::where('email',$request->email)->update([
                    'password' => Hash::make($pass)
                ]);
                return response()->json([
                    'success'=> true,
                    'message'=> 'Password has been send to your mail'
                ]);
            }
        }

        catch (customException $e) {
            return response()->json([
                'success'=> false,
                'message'=> 'Error Occured'
            ]);
        }
    }

    public function getPackages(Request $request){
        $data = DB::table('packages')
                        ->join('games','games.id','=','packages.game_id')
                        ->select('packages.*','games.game_name')
                        ->where('game_id',$request->game_id)
                        ->where('status',1)
                        ->get();

        return response()->json([
            'success'=> true,
            'data'=> $data,
        ]);
    }

    public function packageRequest(Request $request){
        PackageRequest::insert([
            'pakage_id' => $request->pakage_id,
            'user_id' => $request->user_id,
            'amount' => $request->amount,
            'username_email_contact' => $request->username_email_contact,
            'password' => $request->password,
        ]);
        return response()->json([
            'success'=> true,
            'message'=> 'Sent Request Successfully'
        ]);
    }

    public function requestedPackageList(Request $request){

        $data = DB::table('package_requests')
                    ->join('packages','packages.id','=','package_requests.pakage_id')
                    ->join('users','users.id','=','package_requests.user_id')
                    ->select('package_requests.*','packages.title as package_title','users.name as user_name')
                    ->where('package_requests.user_id',$request->user_id)
                    ->get();

        return response()->json([
            'success'=> true,
            'data'=> $data,
        ]);
    }

    public function userAmount(Request $request){
        $data = User::where('id',$request->user_id)->first();
        return response()->json([
            'success'=> true,
            'data'=> $data->amount,
        ]);
    }

    public function subscribedContests(Request $request){
        $data = DB::table('contest_subscriptions')
                    ->join('contests','contests.id','=','contest_subscriptions.contest_id')
                    ->join('games','games.id','=','contests.game_id')
                    ->select('contest_subscriptions.*','contests.title as contest_name','games.game_name')
                    ->where('contest_subscriptions.user_id',$request->user_id)
                    ->get();

        return response()->json([
            'success'=> true,
            'data'=> $data,
        ]);
    }

    public function submitContestRating(Request $request){
        ContestRating::insert([
            'contest_id' => $request->contest_id,
            'user_id' => $request->user_id,
            'star' => $request->star,
            'comments' => $request->comments,
            'created_at' => Carbon::now(),
        ]);
        return response()->json([
            'success'=> true,
            'message'=> 'Rating Submitted Successfully'
        ]);
    }

    public function getContestRatingList(Request $request){
        $data = DB::table('contest_ratings')
                        ->join('contests','contests.id','=','contest_ratings.contest_id')
                        ->join('users','users.id','=','contest_ratings.user_id')
                        ->select('contest_ratings.*','contests.title','users.name as user_name')
                        ->where('contest_ratings.user_id',$request->user_id)
                        ->orderBy('id','desc')
                        ->paginate(15);

        return response()->json([
            'success'=> true,
            'data'=> $data,
        ]);
    }
}
