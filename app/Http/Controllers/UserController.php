<?php

namespace App\Http\Controllers;
use App\User;
use App\Bonus;
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
     public function bonusIndex(){
        $bonuses = Bonus::all();
        return view('backend.edit-bonus',compact('bonuses'));
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
    
      public function changeEmailPage(){
        return view('backend.change_email');
    }

    public function changeMyEmail(Request $request){
        User::where('id',Auth::user()->id)->update([
            'email' =>$request->email
        ]);
        Toastr::success('Email has changed', 'Success');
        return redirect('/home');
    }

    public function unbanUser($id){
        User::where('id',$id)->update([
            'ban' => 0,
            'ban_day' => null
        ]);
        Toastr::success('Unban User', 'Success');
        return redirect('/users/list');
    }
    
    public function userUpdate(Request $request){


            $users = User::find($request->id);
            $users->name = $request->name;
              $users->email = $request->email;
                $users->phone = $request->phone;
                $users->password = $request->password;
                  $users->department = $request->department;
                    $users->semester = $request->semester;
                      $users->profession = $request->profession;
                        $users->details = $request->details;
                          $users->referral_code = $request->referral_code;
                            $users->amount = $request->amount;
                              $users->winning_amount = $request->winning_amount;
                                $users->ban = $request->ban;
                                $users->save();


        return back()->with('message','Department Updated Successfully');
    }
     public function userBonus(Request $request){


            $bonuses = Bonus::find($request->id);
            $bonuses->ref_bonus = $request->ref_bonus;
              $bonuses->reg_bonus = $request->reg_bonus;
         
            $bonuses->save();


        return back()->with('message','Bonus Updated Successfully');
    }
}
