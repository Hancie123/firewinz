<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customers;
use App\Models\RoomsModel;

class customercontroller extends Controller
{
    public function customer(){

        $rooms = RoomsModel::select('room_id', 'room_name')->get();

        
        return view('admin/createcustomers',compact('rooms'));
    }

    public function insertdata(Request $request){
        
        $request->validate(
            [
                'name'=>'required',
                
            ]
            );

            $customer= new Customers;
            $customer->customer_name=$request['name'];
            $customer->email=$request['email'];
            $customer->facebook_link=$request['facebook_link'];
            $customer->phone=$request['mobile'];
            $customer->date=$request['date'];
            $customer->room_id=$request['room_id'];
            $customer->User_ID=$request['User_ID'];
            $customer->save();
            if($customer){
                return back()->with('success','You have successfully created the customer');
            }
            else 
            {
                return back()->with('fail','The error occurred');
            }


        
        
    }

    public function getCustomers()
{
    $customers = Customers::with('room', 'user')->get();

    return response()->json(['data' => $customers]);
    
}

    public function viewcustomer(){
        
        return view('admin/viewcustomers');
    }


}