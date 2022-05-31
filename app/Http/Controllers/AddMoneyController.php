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

    public function getDataForModal($id){
        $product = DB::table('add_money')
                    ->join('users','users.id','=','add_money.user_id')
                    ->select('add_money.*','users.name as user_name')
                    ->where('add_money.id',$id)
                    ->first();

        // return response()->json([
        //     'data' => $product
        // ]);

        return response()->json($product);
    }

    public function updateAddMoneyByModal(Request $request){
        AddMoney::where('id',$request->add_money_id)->update([
            'phone' => $request->phone,
            'customer_number' => $request->customer_number,
            'amount' => $request->amount,
            'refference_no' => $request->refference_no,
            'transaction_id' => $request->transaction_id,
            'updated_at' => Carbon::now(),
        ]);
        return response()->json(['success'=>'Data saved successfully.']);
    }

    public function filterByDate(Request $request){

        $start_date = $request->start_date . " 00:00:00";
        $end_date = $request->end_date . " 23:59:59";

        if($request->start_date == '' || $request->end_date == ''){
            $add_moneys = DB::table('add_money')
                    ->join('users','users.id','=','add_money.user_id')
                    ->select('add_money.*','users.name as user_name')
                    ->orderBy('id','desc')
                    ->paginate(15);

            return view('backend.add_money',compact('add_moneys'));
        }
        else{
            $add_moneys = DB::table('add_money')
                    ->join('users','users.id','=','add_money.user_id')
                    ->select('add_money.*','users.name as user_name')
                    ->whereBetween('add_money.created_at', [$start_date, $end_date])
                    ->orderBy('id','desc')
                    ->paginate(15);

            return view('backend.add_money',compact('add_moneys'));
        }

    }
    
     public function filterByName(Request $request){
         $name = $request->name;
         $add_moneys = DB::table('add_money')
                    ->join('users','users.id','=','add_money.user_id')
                    ->select('add_money.*','users.name as user_name')
                    ->where('users.name','=', $name)
                    ->orderBy('id','desc')
                    ->paginate(15);

            return view('backend.add_money',compact('add_moneys'));
         
     }
}
