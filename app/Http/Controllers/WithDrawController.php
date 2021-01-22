<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\WithDraw;
use App\User;
use App\Payment;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;

class WithDrawController extends Controller
{
    public function withDrawAmountPage(){
        $withdraws = DB::table('with_draws')
                    ->join('users','users.id','=','with_draws.user_id')
                    ->select('with_draws.*','users.name as user_name')
                    ->orderBy('id','desc')
                    ->paginate(15);

        return view('backend.withdraw',compact('withdraws'));
    }

    public function deleteWithdraw($id){
        WithDraw::where('id',$id)->delete();
        Toastr::error('With Draw has been Deleted', 'Success');
        return back();
    }

    public function getDataForModalApproveWithDraw($id){
        $product = DB::table('with_draws')->where('id',$id)->first();
        $phone_of_this_payment_type = Payment::where('type',$product->payment_method)->get();

        $select_options = "<select name='phone' class='form-control' required><option value=''>Select Option</option>";
            foreach($phone_of_this_payment_type as $item){
                $select_options .= "<option value='".$item->number."'>".$item->number."</option>";
            }
        $select_options .= "</select>";

        return response()->json([
            'data' => $product,
            'select_options' => $select_options
        ]);
    }

    public function saveTransactionId(Request $request){
        WithDraw::where('id',$request->product_id)->update([
            'phone' => $request->phone,
            'refference_no' => $request->refference_no,
            'transaction_id' => $request->transaction_id,
            'status' => 1,
            'updated_at' => Carbon::now()
        ]);
        // User::where('id',$request->user_id)->decrement('amount',$request->amount); // already done in api
        return response()->json(['success'=>'Data saved successfully.']);
    }

    public function denyWithDraw($id,$user_id){
        WithDraw::where('id',$id)->update([
            'status' => 2,
            'updated_at' => Carbon::now()
        ]);
        $data = WithDraw::where('id',$id)->first();
        User::where('id',$user_id)->increment('amount',$data->amount);
        Toastr::warning('With Draw has been Denied', 'Denied');
        return back();
    }
}
