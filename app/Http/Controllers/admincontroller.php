<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use App\Models\Users;
use App\Models\ChatModel;
use App\Models\RoomsModel;
use App\Models\Customers;
use App\Models\ExpensesModel;
use App\Models\Products;
use App\Models\Transactions;
use DB;

class admincontroller extends Controller
{
    public function admin(){
        $data=array();
        if(Session::has('Loginid')){
            $data=Users::where('User_ID','=',Session::get('Loginid'))->first();
            Session::put('User_ID',$data->User_ID);
            Session::put('name',$data->name);
            Session::put('email',$data->email);
            
        }
        $viewchat=ChatModel::orderBy('chat_id','desc')->limit(4)->get();
        $workerCount = Users::where('role', '=', 'Worker')->count();
        $countrooms=RoomsModel::count();
        $countcustomer=Customers::count();
        $totalAmount = ExpensesModel::sum('amount');
        $countproducts=Products::count();
        $counttransactions=Transactions::count();
        $customers = Customers::select('date', DB::raw('count(*) as count'))
                ->groupBy('date')
                ->orderBy('date')
                ->pluck('count', 'date');
        $countreferral = Transactions::where('type', '=', 'Referral')->count();
        $countfreeplay = Transactions::where('type', '=', 'Freeplay')->count();

        
        return view('admin/dashboard',compact('viewchat',
        'workerCount','countrooms','countcustomer',
        'totalAmount','countproducts','counttransactions','customers','countreferral','countfreeplay'));
    }

    public function logout(){
        if(Session::has('Loginid')){
            Session::pull('Loginid');
            return redirect('/');
        }


    }
}