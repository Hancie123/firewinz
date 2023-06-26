<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ExpensesModel;

class expensescontroller extends Controller
{
    public function expenses(){
        return view('admin/create_expenses');
    }

    public function insertdata(Request $request){

        $request->validate(
            [
                'date'=>'required',
                'remarks'=>'required',
                'amount'=>'required'
            ]
            );

            $expenses= new ExpensesModel;
            $expenses->date=$request['date'];
            $expenses->remarks=$request['remarks'];
            $expenses->amount=$request['amount'];
            $expenses->User_ID=$request['User_ID'];
            $expenses->save();
            if($expenses){
                return back()->with('success','You have successfully save the expenses detail');
            }
            else 
            {
                return back()->with('fail','The error occurred');
            }
        
    }


    public function getexpenses(){
        

    $expesnestable = ExpensesModel::join('users', 'users.User_ID', '=', 'expenses.User_ID')
    ->select('expenses.expenses_id', 'expenses.date', 'expenses.amount','expenses.remarks','users.name')
    ->get();


    return response()->json(['data' => $expesnestable]);
    }
}