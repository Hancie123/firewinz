<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Users;
use App\Models\RoomsModel;
use App\Models\Access_Control;

class accesscontroller extends Controller
{
    public function accessworker(){

        $users = Users::where('role', 'Worker')->get(['User_ID','name']);
        $rooms = RoomsModel::select('room_id', 'room_name')->get();
        
        
        return view('admin/access_control',compact('users','rooms'));
    }


    public function insertdata(Request $request){

        $request->validate(
            
            [ 
                
                'room_name'=>'required',
                'worker_name'=>'required',
                
            ]
            );


            if (Access_Control::where('User_ID',$request['worker_name'])->where('room_id', $request['room_name'])->exists()) {
            // Record already exists, do something
                return back()->with('fail','This worker is already assigned with this room. Please select another one!');
                
            } else {
                // Record does not exist, insert data
                $access= new Access_Control;
                $access->room_id=$request['room_name'];
                $access->date=$request['date'];
                $access->User_ID=$request['worker_name'];
                $access->save();
                if($access){
                return back()->with('success','You have successfully assigned the room');
                }
             else 
                {
            return back()->with('fail','The error occurred');
                 }
            }

        
        
    }


    public function showRooms()
{
    $user_id = session('User_ID');
    $rooms = RoomsModel::where('User_ID', $user_id)->with('accessControls')->get();
    return view('workers/dashboard', compact('rooms'));
}


    public function accesscontroltable(){

        $accesstable = Access_Control::join('users', 'users.User_ID', '=', 'access_control.User_ID')
    ->join('rooms', 'access_control.room_id', '=', 'rooms.room_id')
    ->where('users.role', '=', 'Worker')
    ->where('users.status', '=', 'Active')
    ->select('access_control.access_id', 'rooms.room_name', 'users.name')
    ->get();


    return response()->json(['data' => $accesstable]);
    }


    public function deleteAccessControl($id) {
        $accessControl = Access_Control::find($id);
    
        if ($accessControl) {
            $accessControl->delete();
    
            return response()->json(['status' => 'success', 'message' => 'Access control record deleted successfully.']);
        } else {
            return response()->json(['status' => 'error', 'message' => 'Access control record not found.']);
        }
    }
    
    

    

}