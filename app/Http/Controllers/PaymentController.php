<?php

namespace App\Http\Controllers;
use App\Payment;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function paymentPage(){
        $payments = Payment::orderBy('id','desc')->paginate(15);
        return view('backend.payment',compact('payments'));
    }

    public function addNewPayment(Request $request){
        Payment::insert([
            'type' => $request->type,
            'number' => $request->number,
            'description' => $request->description,
            'created_at' => Carbon::now(),
        ]);
        Toastr::success('Payment Gateway has been Added', 'Success');
        return back();
    }

    public function deletePayment($id){
        Payment::where('id',$id)->delete();
        Toastr::error('Payment Gateway has been Deleted', 'Deleted');
        return back();
    }
}
