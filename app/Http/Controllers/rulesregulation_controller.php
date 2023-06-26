<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\rules_model;

class rulesregulation_controller extends Controller
{
    public function rulesregulation(){
        $rulescount=rules_model::count();
        $rulesall=rules_model::all();
        
        return view('admin/rules_regulations',compact('rulescount','rulesall'));
    }

    public function insertdata(Request $request){
        $request->validate([
            'content'=>'required'
        ]);

        $rules=new rules_model();
        $rules->rules=$request['content'];
        $rules->User_ID=$request['User_ID'];
        $rules->save();
        if($rules){
            return back()->with('success','You have successfully 
            publish the rules and regulations for workers');
        }
        else {
            return back()->with('fail','Some error occurred');
        }
        
    }

    public function edit(Request $request,$id){
        
        $rule=rules_model::find($id);
        $rule->rules=$request['content'];
        $rule->User_ID=$request['User_ID'];
        $rule->update();
        if($rule){
            
            return back()->with('success',"The rules and regulations is modified successfully!");
        }
        else{
            return back()->with('fail',"Error Occurred");
        }
        
    }


    public function delete($id){
        
        $rule=rules_model::find($id);
        $rule->delete();
        if($rule){
            
            return back()->with('success',"The rules and regulations is deleted successfully!");
        }
        else{
            return back()->with('fail',"Error Occurred");
        }
        
    }
}