<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AnnouncementModel;
use Mail;

class announcementcontroller extends Controller
{
    public function announce(){

        $countannouncement=AnnouncementModel::count();
        $announceall=AnnouncementModel::all();

        
        return view('admin/announcement',compact('countannouncement','announceall'));
    }



    

    public function makeannouncement(Request $request){

        $request->validate([
            'title'=>'required',
            'announcement'=>'required'
        ]);

        // $data = [
        //     'announcement' => $request->announcement,
        //     'title' => $request->title,
        // ];
        
        // $recipients = [
        //     'hanciewanemphago@gmail.com',
        //     'nitesh0hamal@gmail.com',
           
        // ];
        
        // foreach ($recipients as $recipient) {
        //     Mail::send('mailtemplates/announcement', $data, function($message) use ($recipient, $data) {
        //         $message->to($recipient);
        //         $message->subject($data['title']);
        //     });
        // }


        $announce= new AnnouncementModel;
        $announce->title=$request['title'];
        $announce->announcement=$request['announcement'];
        $announce->User_ID=$request['User_ID'];
        $announce->save();
        if($announce){
            return back()->with('success','You have successfully done the announcement to all workers');
        }
        else 
        {
            return back()->with('fail','The error occurred');
        }
        
    }


    public function deletedata($id){

        $announce=AnnouncementModel::find($id);
        if(!is_null($announce)){
            $announce->delete();
            return back()->with('success',"The announcement is deleted successfully");
        }
        else{
            return back()->with('fail',"Error Occurred");
        }
        
    }
}