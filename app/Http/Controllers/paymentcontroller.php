<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Payments;
use App\Models\RoomsModel;
use App\Models\Users;

class paymentcontroller extends Controller
{
    public function payment(){

        $rooms = RoomsModel::select('room_id', 'room_name')->get();
        
        return view('admin/create_payments',compact('rooms'));
    }

    public function insertdata(Request $request){

        $request->validate([
            'payment_name'=>'required',
            
        ]);

        $payment= new Payments;
        $payment->payment_name=$request['payment_name'];
        $payment->date=$request['date'];
        $payment->room_id=$request['room_id'];
        $payment->User_ID=$request['User_ID'];
        $payment->save();
        if($payment){
            return back()->with('success','You have successfully created the payment');
        }
        else 
        {
            return back()->with('fail','The error occurred');
        }
        
    }

    public function getpaymenttable(){

        $payments = Payments::with('room', 'user')->get();
        
        return response()->json(['data' =>$payments]);
    }

    public function viewpayments(){
        return view('admin/view_payments');
    }
}