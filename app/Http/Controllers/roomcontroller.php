<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RoomsModel;

class roomcontroller extends Controller
{
    public function rooms(){
        return view('admin/createrooms');
    }

    public function insertdata(Request $request){

        $request->validate(
            [
                'name'=>'required'
            ]
            );

        $room= new RoomsModel;
        $room->room_name=$request['name'];
        $room->User_ID=$request['User_ID'];
        $room->save();
        if($room){
            return back()->with('success','You have successfully created the room');
        }
        else 
        {
            return back()->with('fail','The error occurred');
        }
        
    }

    public function roomajax(){
        $rooms = Room::select('room_id', 'room_name', 'name')
             ->join('users', 'rooms.User_ID', '=', 'users.User_ID')
             ->get();

             
    }
}