<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\RoomsModel;

class cashin_cashout_controller extends Controller
{
    public function cashin_cashout(Request $request){

        
        $rooms = RoomsModel::select('room_id', 'room_name')->get();
        $user_id = session('User_ID');
        $room_name=$request->room_id;
        $days=$request->no_of_days;

        if (is_numeric($days)) {
            
        $data = DB::table('payment_balance')
            ->select(
        DB::raw('date'),
        DB::raw('SUM(CASE WHEN status = "Deposit" THEN cash_balance ELSE -cash_balance END) as gross_cash_amount'),
        DB::raw('SUM(CASE WHEN status = "Deposit" THEN cash_balance ELSE 0 END) as cashin'),
        DB::raw('SUM(CASE WHEN status = "Withdraw" THEN cash_balance ELSE 0 END) as cashout')
    )
        ->where('room_id', '=', $room_name)
        ->whereIn('status', ['Deposit', 'Withdraw'])
        ->where('date', '>', now()->subDays($days)->toDateString()) // Fetch data from the last 15 days
        ->groupBy('date')
        ->get();

    $fifteendays = "";
    foreach ($data as $val) {
        $fifteendays .= "['" . $val->date . "', " . $val->cashin . "," . $val->cashout . ", " . $val->gross_cash_amount . "],";
    }

    $fifteendaysChart = $fifteendays;


    $cashin = DB::table('payment_balance')
            ->select(DB::raw('SUM(cash_balance) as cash'))
            ->where('room_id', '=', $room_name)
            ->where('status', '=', 'Deposit')
            ->where('date', '>=', now()->subDays($days)->toDateString()) 
            ->get();

    $cashout = DB::table('payment_balance')
            ->select(DB::raw('SUM(cash_balance) as cash'))
            ->where('room_id', '=', $room_name)
            ->where('status', '=', 'Withdraw')
            ->where('date', '>', now()->subDays($days)->toDateString()) 
            ->get();
            
        } 
        
        
        else {

            
        $data = DB::table('payment_balance')
            ->select(
        DB::raw('date'),
        DB::raw('SUM(CASE WHEN status = "Deposit" THEN cash_balance ELSE -cash_balance END) as gross_cash_amount'),
        DB::raw('SUM(CASE WHEN status = "Deposit" THEN cash_balance ELSE 0 END) as cashin'),
        DB::raw('SUM(CASE WHEN status = "Withdraw" THEN cash_balance ELSE 0 END) as cashout')
    )
        ->where('room_id', '=', $room_name)
        ->whereIn('status', ['Deposit', 'Withdraw'])
        ->groupBy('date')
        ->get();

    $fifteendays = "";
    foreach ($data as $val) {
        $fifteendays .= "['" . $val->date . "', " . $val->cashin . "," . $val->cashout . ", " . $val->gross_cash_amount . "],";
    }

    $fifteendaysChart = $fifteendays;


    $cashin = DB::table('payment_balance')
            ->select(DB::raw('SUM(cash_balance) as cash'))
            ->where('room_id', '=', $room_name)
            ->where('status', '=', 'Deposit')
            ->get();

    $cashout = DB::table('payment_balance')
            ->select(DB::raw('SUM(cash_balance) as cash'))
            ->where('room_id', '=', $room_name)
            ->where('status', '=', 'Withdraw')
            ->get();
        }

        return view('admin/cashin_cashout_analytics',compact('days',
        'rooms','fifteendaysChart','cashin','cashout'));
    }








    

    public function searchresult(Request $request){
        
        $request->validate([
            'room_id'=>'required',
            'no_of_days'=>'required'
        ]);

        $data = DB::table('payment_balance')
            ->select(
        DB::raw('date'),
        DB::raw('SUM(CASE WHEN status = "Deposit" THEN cash_balance ELSE -cash_balance END) as gross_cash_amount'),
        DB::raw('SUM(CASE WHEN status = "Deposit" THEN cash_balance ELSE 0 END) as cashin'),
        DB::raw('SUM(CASE WHEN status = "Withdraw" THEN cash_balance ELSE 0 END) as cashout')
    )
        ->where('room_id', '=', $room_name)
        ->whereIn('status', ['Deposit', 'Withdraw'])
        ->where('date', '>=', now()->subDays(15)->toDateString()) // Fetch data from the last 15 days
        ->groupBy('date')
        ->get();

    $fifteendays = "";
    foreach ($data as $val) {
        $fifteendays .= "['" . $val->date . "', " . $val->cashin . "," . $val->cashout . ", " . $val->gross_cash_amount . "],";
    }

    $fifteendaysChart = $fifteendays;
    }
}