<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use App\Models\Users;
use App\Models\RoomsModel;
use App\Models\Access_Control;
use DB;
use App\Models\Customers;
use App\Models\Products;
use App\Models\Payments;
use App\Models\Transactions;
use App\Models\Payment_Balance;
use App\Models\Product_Balance;
use App\Models\rules_model;
use Session;

class user_profile_controller extends Controller
{
    public function adminprofile(){
        return view('admin/profile');
    }

    public function workerprofile(){
        $user_id = session('User_ID');

        $access_controls = DB::table('access_control')
         ->join('rooms', 'access_control.room_id', '=', 'rooms.room_id')
         ->where('access_control.User_ID', $user_id)
         ->select('access_control.User_ID', 'access_control.status', 'rooms.room_name','access_control.room_id')
         ->get();

        $access_controls2 = DB::table('rooms')
            ->join('access_control', 'rooms.room_id', '=', 'access_control.room_id')
            ->select('rooms.room_name','rooms.room_id')
            ->where('access_control.User_ID', '=', $user_id)
            ->where('access_control.status', '=', DB::raw('rooms.room_id'))
            ->get();

        $room_name = session('room_name');
        
        $countrooms = Access_Control::where('User_ID', $user_id)->count();
        $rulescount=rules_model::count();
        $rulesall=rules_model::all();
        $countcustomer=Customers::Where('User_ID',$user_id)->count('customer_id');

        $totalcashin = DB::table('payment_balance')
            ->select(DB::raw('SUM(cash_balance) as total'))
            ->where('User_ID', '=', $user_id)
            ->where('status', '=', 'Deposit')
            ->first();

        $sumcheckin = $totalcashin->total;


        $cashout = DB::table('payment_balance')
            ->select(DB::raw('SUM(cash_balance) as total'))
            ->where('User_ID', '=', $user_id)
            ->where('status', '=', 'Withdraw')
            ->first();

            $sumcheckout = $cashout->total;


        return view('workers/profile',compact('sumcheckout','sumcheckin','countcustomer','rulescount','rulesall',
        'access_controls2','countrooms','access_controls'));
    }

    public function changepassword(Request $request){
        $request->validate([
            'current_password'=>'required',
            'new_password'=>'required',
            'confirm_password'=>'required|same:new_password'
        ]);
        $email = Session('email');
        $user=Users::Where('email',$email )->first();

        if (!$user) {
            return back()->with('error', 'User not found');
        }
        
        if (!Hash::check($request->current_password, $user->password)) {
        return back()->with('error','The current password does not match');
    }

    $user->password = Hash::make($request->new_password);
    $user->save();

    return redirect('/')->with('success', 'Password changed successfully');
    
    }
}