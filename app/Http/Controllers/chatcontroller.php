<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ChatModel;
use DB;
use App\Models\Access_Control;
use App\Models\rules_model;

class chatcontroller extends Controller
{
    public function adminchat(){

        $viewchat=ChatModel::orderBy('chat_id','desc')->get();
        
        return view('admin/chat',compact('viewchat'));
    }

    public function workerchat(){

        $user_id = session('User_ID');

        $countrooms = Access_Control::where('User_ID', $user_id)->count();

        $access_controls2 = DB::table('rooms')
            ->join('access_control', 'rooms.room_id', '=', 'access_control.room_id')
            ->select('rooms.room_name','rooms.room_id')
            ->where('access_control.User_ID', '=', $user_id)
            ->where('access_control.status', '=', DB::raw('rooms.room_id'))
            ->get();

        $access_controls = DB::table('access_control')
            ->join('rooms', 'access_control.room_id', '=', 'rooms.room_id')
            ->where('access_control.User_ID', $user_id)
            ->select('access_control.User_ID', 'access_control.status', 'rooms.room_name','access_control.room_id')
            ->get();

        $viewchat=ChatModel::orderBy('chat_id','desc')->get();
        $rulescount=rules_model::count();
        $rulesall=rules_model::all();
        
        return view('workers/chat',compact('rulescount','rulesall','viewchat','access_controls2','countrooms','access_controls'));
    }


    public function insertchat(Request $request){
        $request->validate([

            'message'=>'required'
 
        ]);


        $chat=new ChatModel;
        $chat->name=$request['name'];
        $chat->message=$request['message'];
        $chat->User_ID=$request['User_ID'];
        $chat->save();
        if ($chat){
                
            return back();
            
        }
        else{
                return back();
        }

    }

   
}