<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Products;
use App\Models\RoomsModel;
use DB;

class productcontroller extends Controller
{
    public function products(){

        $rooms = RoomsModel::select('room_id', 'room_name')->get();

        
        return view('admin/create_products',compact('rooms'));
    }

    public function insertdata(Request $request){

        $request->validate([
            'product_name'=>'required',
            
            
        ]);

        $product= new Products;
        $product->product_name=$request['product_name'];
        $product->date=$request['date'];
        $product->room_id=$request['room_id'];
        $product->User_ID=$request['User_ID'];
        $product->save();
        if($product){
            return back()->with('success','You have successfully created the product');
        }
        else 
        {
            return back()->with('fail','The error occurred');
        }
        
    }

    public function getProductsAndRooms()
{
    $products = DB::table('products')
                    ->leftJoin('rooms', 'products.room_id', '=', 'rooms.room_id')
                    ->select('products.product_id', 'products.product_name', 'products.room_id', 'products.date', 'rooms.room_name')
                    ->get();
                    

        return response()->json(['data' =>$products]);
}

    public function viewproducts(){

        return view('admin/view_products');
        
    }


    

    
    
}