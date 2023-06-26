<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Models\Access_Control;
use App\Models\RoomsModel;
use App\Models\ShiftModel;
use App\Models\rules_model;

class shiftreportcontroller extends Controller
{
    public function shiftreport(){

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

        $room_name = session('room_name');

        $gamedata=DB::table('products as p')
            ->select('p.product_name', DB::raw('(SELECT SUM(CASE WHEN status = "Deposit" 
            THEN credit_balance ELSE -credit_balance END) FROM product_balance WHERE 
            product_id = p.product_id) as gross_credit_amount'))
            ->join('product_balance as pb', 'pb.product_id', '=', 'p.product_id')
            ->where('pb.room_id', '=', $room_name)
            ->groupBy('p.product_id','p.product_name')
            ->get();

        $countgamedata   = DB::table('products as p')
        ->select(
            DB::raw('COUNT(pb.product_id) as count')
        )
        ->join('product_balance as pb', 'pb.product_id', '=', 'p.product_id')
        ->where('pb.room_id', '=', $room_name)
        ->groupBy('p.product_id')
        ->get();

        $rulescount=rules_model::count();
        $rulesall=rules_model::all();
        


        
        return view('workers/shiftreport',compact('access_controls2','countrooms',
        'access_controls','gamedata','countgamedata','rulescount','rulesall'));
    }

    public function saveshiftdata(Request $request)
{

    $request->validate(
        [
            'gamebackendbalance.*' => 'required',
        ]
        );

        
    $game = $request->input('game');
    $gamebalance = $request->input('gamebalance');
    $backendbalance = $request->input('gamebackendbalance');
    $room_id = $request->input('room_id');
    $user_id = $request->input('User_ID');

    // Loop through the arrays and save each product
    for ($i = 0; $i < count($game); $i++) {
        $shift = new ShiftModel;
        $shift->gamename = $game[$i];
        $shift->gamebalance = $gamebalance[$i];
        $shift->gamebackendbalance = $backendbalance[$i];
        $shift->room_id = $room_id[$i];
        $shift->User_ID = $user_id[$i];
        $shift->save();
        
        
        }

        if($shift){
            return back()->with('success','You have successfully save the shift data');
        }
        else 
        {
            return back()->with('fail','The error occurred');
        }
}
    
     public function adminviewshifttable(){
        return view('admin/viewshiftreport');
     }


     public function gettabledata(){

        $shifttable = ShiftModel::join('users', 'users.User_ID', '=', 'shift.User_ID')
        ->join('rooms', 'rooms.room_id', '=', 'shift.room_id')
        ->select('shift.shift_id', 'shift.gamename', 'shift.gamebalance','shift.gamebackendbalance','rooms.room_name','users.name','shift.created_at')
        ->orderByDesc('shift.created_at')
        ->get();
    


    
    return response()->json(['data' => $shifttable]);
    }


}