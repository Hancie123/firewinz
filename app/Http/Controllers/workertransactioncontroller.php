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
use App\Models\rules_model;

class workertransactioncontroller extends Controller
{
    public function transaction(){

        $rooms = RoomsModel::select('room_id', 'room_name')->get();
        $customers = Customers::select('customer_id', 'customer_name')->get();
        $games = Products::select('product_id', 'product_name')->get();
        $payments = Payments::select('payment_id', 'payment_name')->get();

        $user_id = session('User_ID');
        $access_controls = DB::table('access_control')
         ->join('rooms', 'access_control.room_id', '=', 'rooms.room_id')
         ->where('access_control.User_ID', $user_id)
         ->select('access_control.User_ID', 'access_control.status', 'rooms.room_name','access_control.room_id')
         ->get();


         $user_id = session('User_ID');

         $access_controls2 = DB::table('rooms')
         ->join('access_control', 'rooms.room_id', '=', 'access_control.room_id')
         ->select('rooms.room_name','rooms.room_id')
         ->where('access_control.User_ID', '=', $user_id)
         ->where('access_control.status', '=', DB::raw('rooms.room_id'))
         ->get();
         
         $countrooms = Access_Control::where('User_ID', $user_id)->count();
         $rulesall=rules_model::all(); 
        $rulescount=rules_model::count();  


        return view('workers/create_transactions',compact('rulescount','rulesall','rooms','customers','games',
        'payments','access_controls','countrooms','access_controls2'));
    }


    public function getTransactions()
        {
    $transactions = Transactions::join('customers', 'transactions.customer_id', '=', 'customers.customer_id')
    ->join('products', 'transactions.product_id', '=', 'products.product_id')
    ->join('users', 'transactions.User_ID', '=', 'users.User_ID')
    ->join('payments', 'transactions.payment_id', '=', 'payments.payment_id')
    ->select('transactions.transaction_id', 'transactions.type', 'transactions.note', 
    'transactions.cash', 'transactions.cash_identifier','transactions.Credit','transactions.date', 
    'customers.customer_name as name', 'products.product_name as product_name', 
    'users.name as user_name', 'payments.payment_name as payment_name')
    ->get();


        return response()->json(['data' => $transactions]);

        }

    public function viewtransactions(){

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
        
        return view('workers/view_transaction',compact('rulescount','rulesall','access_controls2','countrooms','access_controls'));
    }
}