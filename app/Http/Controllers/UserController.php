<?php

namespace App\Http\Controllers;
use App\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
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

    public function changePasswordPage(){
        return view('backend.change_password');
    }

    public function changeMyPassword(Request $request){
        User::where('id',Auth::user()->id)->update([
            'password' => Hash::make($request->password)
        ]);
        Toastr::success('Password has changed', 'Success');
        return redirect('/home');
    }
}
