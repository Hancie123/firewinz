<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\RoomsModel;
use App\Models\Customers;
use App\Models\Products;
use App\Models\Payments;
use App\Models\Transactions;
use App\Models\Payment_Balance;
use App\Models\Product_Balance;
use DB;
use Session;

class Customers extends Component
{

    public function mount()
    {
        $user_id = session('User_ID');
        $this->rooms = RoomsModel::select('room_id', 'room_name')->get();
        $this->customers = Customers::select('customer_id', 'customer_name')->get();
        $this->games=Products::select('product_id', 'product_name')->get();
        $this->payments=Payments::select('payment_id', 'payment_name')->get();
        $this->access_controls2 = RoomsModel::join('access_control', 'rooms.room_id', '=', 'access_control.room_id')
        ->select('rooms.room_name', 'rooms.room_id')
        ->where('access_control.User_ID', $user_id)
        ->whereColumn('access_control.status', 'rooms.room_id')
        ->get();
        
    }

    public function render()
    {
        return view('livewire.customers');
    }
}
