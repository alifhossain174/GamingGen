<?php

namespace App\Http\Controllers;
use App\User;
use App\AddMoney;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class AddMoneyController extends Controller
{
    public function addMoneyPage(){
        $add_moneys = DB::table('add_money')
                    ->join('users','users.id','=','add_money.user_id')
                    ->select('add_money.*','users.name as user_name')
                    ->orderBy('id','desc')
                    ->paginate(15);

        return view('backend.add_money',compact('add_moneys'));
    }

    public function deleteAddMoney($id){
        AddMoney::where('id',$id)->delete();
        Toastr::error('Add Money has been Deleted', 'Success');
        return back();
    }

    public function approveAddMoney($id,$user_id){
        AddMoney::where('id',$id)->update([
            'status' => 1,
            'updated_at' => Carbon::now(),
        ]);
        $data = AddMoney::where('id',$id)->first();
        User::where('id',$user_id)->increment('amount',$data->amount);
        Toastr::success('Add Money has been Approvd', 'Success');
        return back();
    }

    public function denyAddMoney($id){
        AddMoney::where('id',$id)->update([
            'status' => 2,
            'updated_at' => Carbon::now(),
        ]);
        Toastr::warning('Add Money has been Denied', 'Success');
        return back();
    }
}
