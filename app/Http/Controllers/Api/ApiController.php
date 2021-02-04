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
use App\Payment;
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
            $winning_amount = Auth::user()->winning_amount;
            $image = Auth::user()->image;
            $department = Auth::user()->department;
            $semester = Auth::user()->semester;
            $profession = Auth::user()->profession;
            $details = Auth::user()->details;

            if(Auth::user()->ban == 1){
                if(Auth::user()->ban_day > date("Y-m-d")){
                    return response()->json([
                        'success' => false,
                        'message' => 'This User is Banned'
                    ])->setStatusCode(200);
                }
                else{
                    User::where('email',$request->email)->update([
                        'ban' => 0,
                        'ban_day' => Null
                    ]);
                    $data=array('id'=>$id,'name'=>$name,'email'=>$email,'referral_code' => $referral_code, 'amount' => $amount, 'winning_amount' => $winning_amount, 'phone' => $phone, 'image' => $image, 'department' => $department, 'semester' => $semester, 'profession' => $profession, 'details' => $details);
                    return response()->json(['success' =>true,'data'=>$data]);
                }
            }

            $data=array('id'=>$id,'name'=>$name,'email'=>$email,'referral_code' => $referral_code, 'amount' => $amount, 'winning_amount' => $winning_amount, 'phone' => $phone, 'image' => $image, 'department' => $department, 'semester' => $semester, 'profession' => $profession, 'details' => $details);
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
        $data = Slider::orderBy('id','desc')->get();
        return response()->json([
            'success'=> true,
            'data'=> $data,
        ]);
    }

    public function getGames(){
        $data = Game::orderBy('id','desc')->get();
        return response()->json([
            'success'=> true,
            'data'=> $data,
        ]);
    }

    public function getTrends(){
        $trends = DB::table('trends')
                    ->join('games','games.id','=','trends.game_id')
                    ->select('trends.*','games.game_name','games.package_name')
                    ->orderBy('id','desc')
                    ->paginate(15);

        return response()->json([
            'success'=> true,
            'data'=> $trends,
        ]);
    }

    public function getContests(Request $request){
        $lists = Contest::where('status',1)->where('game_id',$request->game_id)->orderBy('id','desc')->get();
        $data = array();
        foreach($lists as $list){
            $info = DB::table('contests')
                        ->join('games','games.id','=','contests.game_id')
                        ->select('contests.*','games.game_name','games.package_name')
                        ->where('contests.id',$list->id)
                        ->first();

            if(DB::table('contest_subscriptions')->where('contest_id',$list->id)->where('user_id',$request->user_id)->exists()){
                $status = DB::table('contest_subscriptions')->where('contest_id',$list->id)->where('user_id',$request->user_id)->first();
                $subscribed = 0;
                if($status->status == 0){
                    $subscribed = 3;
                }
                if($status->status == 1){
                    $subscribed = 1;
                }
                if($status->status == 2){
                    $subscribed = 2;
                }
                $data[] = array('id' => $info->id, 'game_id' => $list->game_id, 'game_code' => $list->game_code, 'close' => $list->close, 'joining_link' => $list->joining_link, 'room_no' => $list->room_no, 'description' => $list->description, 'package_name' => $info->package_name, 'title' => $info->title, 'date' => $info->date, 'time' => $info->time, 'status' => $info->status, 'amount' => $info->amount, 'first' => $list->first, 'second' => $list->second, 'third' => $list->third, 'subscribed' => $subscribed);
            }
            else{
                $data[] = array('id' => $info->id, 'game_id' => $list->game_id, 'game_code' => $list->game_code, 'close' => $list->close, 'joining_link' => $list->joining_link, 'room_no' => $list->room_no, 'description' => $list->description, 'package_name' => $info->package_name, 'title' => $info->title, 'date' => $info->date, 'time' => $info->time, 'status' => $info->status, 'amount' => $info->amount, 'first' => $list->first, 'second' => $list->second, 'third' => $list->third, 'subscribed' => 0);
            }
        }
        return response()->json([
            'success'=> true,
            'data'=> $data,
        ]);
    }

    public function getPrevContests(Request $request){
        // $data = Contest::where('status',0)->where('game_id',$request->game_id)->orderBy('id','desc')->paginate(15);
        $data = DB::table('contests')
                        ->join('games','games.id','=','contests.game_id')
                        ->select('contests.*','games.game_name','games.package_name')
                        ->where('contests.game_id',$request->game_id)
                        ->orderBy('contests.id','desc')
                        ->paginate(15);

        return response()->json([
            'success'=> true,
            'data'=> $data,
        ]);
    }

    public function subscribeContest(Request $request){
        $user_info = User::where('id',$request->user_id)->first();
        $info = Contest::where('id',$request->contest_id)->first();

        $already_subscribed_participants = ContestSubscription::where('contest_id',$request->contest_id)->where('status',1)->count();

        if($info->close == 0){
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
                        'email' => $request->email,
                        'password' => $request->password,
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
        else{
            return response()->json([
                'success'=> false,
                'message'=> 'Contest is Closed'
            ]);
        }

    }

    public function winningContestLists(Request $request){
        $data = DB::table('contest_winners')
                        ->join('contests','contests.id','=','contest_winners.contest_id')
                        ->join('games','games.id','=','contest_winners.game_id')
                        ->join('users','users.id','=','contest_winners.user_id')
                        ->select('contests.title as contest_name','games.game_name', 'games.logo', 'users.name as user_name','contest_winners.position','contest_winners.winning_amount','contest_winners.kill')
                        ->where('contest_winners.user_id',$request->user_id)
                        ->orderBy('contest_winners.id','desc')
                        ->paginate(15);

        return response()->json([
            'success'=> true,
            'data'=> $data,
        ]);
    }

    public function winningContestListsByContest(Request $request){
        $data = DB::table('contest_winners')
                ->join('contests','contests.id','=','contest_winners.contest_id')
                ->join('games','games.id','=','contest_winners.game_id')
                ->join('users','users.id','=','contest_winners.user_id')
                ->select('contests.title as contest_name','games.game_name', 'games.logo', 'users.name as user_name', 'users.image', 'contest_winners.position','contest_winners.winning_amount','contest_winners.kill')
                ->where('contest_winners.contest_id',$request->contest_id)
                ->orderBy('contest_winners.id','desc')
                ->get();

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
        if($user_info->winning_amount < $request->amount){
            return response()->json([
                'success'=> false,
                'message'=> 'Sorry! Dont have enough winning amount to withdraw'
            ]);
        }
        else{
            WithDraw::insert([
                'user_id' => $request->user_id,
                'phone' => $request->phone,
                'customer_number' => $request->customer_number,
                'payment_method' => $request->payment_method,
                'amount' => $request->amount,
                'refference_no' => $request->refference_no,
                'created_at' => Carbon::now()
            ]);
            User::where('id',$request->user_id)->decrement('winning_amount',$request->amount);
            return response()->json([
                'success'=> true,
                'message'=> 'Amount Withdraw request has been sent'
            ]);
        }
    }

    public function withDrawAmountHistory(Request $request){
        $withdraw_history = WithDraw::where('user_id',$request->user_id)->orderBy('id','desc')->get();
        return response()->json([
            'success'=> true,
            'data'=> $withdraw_history,
        ]);
    }

    public function addMoney(Request $request){
        AddMoney::insert([
            'user_id' => $request->user_id,
            'phone' => $request->phone,
            'customer_number' => $request->customer_number,
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
        $add_money_history = AddMoney::where('user_id',$request->user_id)->orderBy('id','desc')->get();
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
                        ->orderBy('id','desc')
                        ->get();

        return response()->json([
            'success'=> true,
            'data'=> $data,
        ]);
    }

    public function packageRequest(Request $request){
        $user_info = User::where('id',$request->user_id)->first();
        $package_info = Package::where('id',$request->pakage_id)->first();

        if($user_info->amount < $package_info->amount){
            return response()->json([
                'success'=> false,
                'message'=> 'Not Enough Balance'
            ]);
        }
        else{
            User::where('id',$request->user_id)->decrement('amount',$package_info->amount);
            PackageRequest::insert([
                'pakage_id' => $request->pakage_id,
                'user_id' => $request->user_id,
                'amount' => $package_info->amount,
                'username_email_contact' => $request->username_email_contact,
                'password' => $request->password,
            ]);
            return response()->json([
                'success'=> true,
                'message'=> 'Sent Request Successfully'
            ]);
        }


    }

    public function requestedPackageList(Request $request){

        $data = DB::table('package_requests')
                    ->join('packages','packages.id','=','package_requests.pakage_id')
                    ->join('users','users.id','=','package_requests.user_id')
                    ->select('package_requests.*','packages.title as package_title','packages.diamond','users.name as user_name')
                    ->where('package_requests.user_id',$request->user_id)
                    ->orderBy('id','desc')
                    ->get();

        return response()->json([
            'success'=> true,
            'data'=> $data,
        ]);
    }

    public function userAmount(Request $request){
        $data = array();
        $info = User::where('id',$request->user_id)->first();
        $data['amount'] = $info->amount;
        $data['winning_amount'] = $info->winning_amount;

        return response()->json([
            'success'=> true,
            'data'=> $data,
        ]);
    }

    public function subscribedContests(Request $request){
        $data = DB::table('contest_subscriptions')
                    ->join('contests','contests.id','=','contest_subscriptions.contest_id')
                    ->join('games','games.id','=','contests.game_id')
                    ->select('contest_subscriptions.*','contests.title as contest_name','games.game_name','contests.game_code','contests.first','contests.second','contests.third')
                    ->where('contest_subscriptions.user_id',$request->user_id)
                    ->orderBy('contest_subscriptions.id','desc')
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
                        ->join('games','games.id','=','contests.game_id')
                        ->join('users','users.id','=','contest_ratings.user_id')
                        ->select('contest_ratings.*','contests.title','users.name as user_name','games.game_name','games.logo as game_logo')
                        ->where('contest_ratings.user_id',$request->user_id)
                        ->orderBy('id','desc')
                        ->paginate(15);

        return response()->json([
            'success'=> true,
            'data'=> $data,
        ]);
    }

    public function getPaymentInfo(Request $request){
        if($request->type == "bkash"){
            $data = Payment::where('type','bkash')->orderBy('id','desc')->get();
            return response()->json([
                'success'=> true,
                'data'=> $data,
            ]);
        }
        if($request->type == "rocket"){
            $data = Payment::where('type','rocket')->orderBy('id','desc')->get();
            return response()->json([
                'success'=> true,
                'data'=> $data,
            ]);
        }
        if($request->type == "nagad"){
            $data = Payment::where('type','nagad')->orderBy('id','desc')->get();
            return response()->json([
                'success'=> true,
                'data'=> $data,
            ]);
        }
        if($request->type == "all"){
            $data = Payment::orderBy('type','desc')->orderBy('id','desc')->get();
            return response()->json([
                'success'=> true,
                'data'=> $data,
            ]);
        }
    }

}
