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

class FirewinzTransaction extends Component
{
    public $rooms;
    public $customers;
    public $games;
    public $payments;
    public $access_controls2;
    

    public $cash_identifier;
    public $customer_name;
    public $game_name;
    public $type;
    public $payment_method;
    public $sender_receiver_id;
    public $note;
    public $cash;
    public $credit;
    public $date;
    public $User_ID;
    public $room_id;

    protected $rules=[
        'cash_identifier'=>'unique:transactions,cash_identifier',
        // 'customer_name'=>'required',
        // 'game_name'=>'required',
        // 'type'=>'required',
        // 'payment_method'=>'required',
        // 'note'=>'required',
        // 'cash'=>'required|numeric',
        // 'credit'=>'required|numeric',

    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

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
        return view('livewire.firewinz-transaction');
    }
}
