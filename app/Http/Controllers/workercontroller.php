<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
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
use App\Models\ClockModel;
use App\Models\AnnouncementModel;
use App\Models\rules_model;

class workercontroller extends Controller



{

    public function switchrooms(Request $request) {
        
        $room_name = $request->input('room_name');
        $user_id = session('User_ID');
        Access_Control::where('User_ID', $user_id)->update(['status' => $room_name]);
        Session::put('room_name', $room_name);
        return back();
    }

    
    public function dashboard(Request $request){

        $data=array();
        if(Session::has('Loginid')){
            $data=Users::where('User_ID','=',Session::get('Loginid'))->first();
            Session::put('User_ID',$data->User_ID);
            Session::put('name',$data->name);
            Session::put('email',$data->email);


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




         
         $countrooms = Access_Control::where('User_ID', $user_id)->count();
         
         $countclockinstatus = ClockModel::where('User_ID', $user_id)
                                 ->where('currentstatus', 'CheckIn')
                                 ->where('currentstatus', '<>', 'CheckOut')
                                 ->orderBy('created_at', 'desc')
                                 ->count();

        $countclockoutstatus = ClockModel::where('User_ID', $user_id)
                    ->where('currentstatus', 'CheckOut')
                    ->where('currentstatus', '<>', 'CheckIn')
                    ->orderBy('created_at', 'desc')
                    ->count();

        $room_name = session('room_name');
        
        $cashin = DB::table('payment_balance')
            ->select(DB::raw('SUM(cash_balance)'))
            ->where('User_ID', '=', $user_id)
            ->where('room_id', '=', $room_name)
            ->where('status', '=', 'Deposit')
            ->where('created_at', '>=', now()->subHours(12))
            ->get();


    $cashout = DB::table('payment_balance')
            ->select(DB::raw('SUM(cash_balance)'))
            ->where('User_ID', '=', $user_id)
            ->where('room_id', '=', $room_name)
            ->where('status', '=', 'Withdraw')
            ->where('created_at', '>=', now()->subHours(12))
            ->get();


    $grosscashamount = DB::table('payment_balance')
            ->select(DB::raw('SUM(CASE WHEN status = "Deposit" THEN cash_balance ELSE 
            -cash_balance END) as gross_cash_amount'))
            ->where('User_ID', '=', $user_id)
            ->where('room_id', '=', $room_name)
            ->whereIn('status', ['Deposit', 'Withdraw'])
            ->where('created_at', '>=', now()->subHours(12))
            ->get();


        $gamedata=DB::table('products as p')
                    ->select('p.product_name', DB::raw('(SELECT SUM(CASE WHEN status = "Deposit" 
                    THEN credit_balance ELSE -credit_balance END) FROM product_balance WHERE 
                    product_id = p.product_id) as gross_credit_amount'))
                    ->join('product_balance as pb', 'pb.product_id', '=', 'p.product_id')
                    ->where('pb.room_id', '=', $room_name)
                    ->groupBy('p.product_id','p.product_name')
                    ->get();

        $countannouncement=AnnouncementModel::count();
        $announceall=AnnouncementModel::all();
        $rulesall=rules_model::all(); 
        $rulescount=rules_model::count();     
       
            
        }
        return view('workers/dashboard',compact('access_controls',
        'countrooms','access_controls2','countclockinstatus',
        'countclockoutstatus','cashin','cashout','rulescount','grosscashamount','rulesall','gamedata','countannouncement','announceall'));
    }

    


    
}