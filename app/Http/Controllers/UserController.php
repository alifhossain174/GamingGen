<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function allUserList(){
        $users = User::where('id','!=',1)->get();
        return view('backend.all_users',compact('users'));
    }

    public function bannedUsers(Request $request){

        $NewDate=date('Y-m-d', strtotime('+'.$request->ban_day.' days'));

        User::where('id',$request->user_id)->update([
            'ban' => 1,
            'ban_day' => $NewDate
        ]);

        return response()->json(['success'=>'Data saved successfully.']);
    }
}
