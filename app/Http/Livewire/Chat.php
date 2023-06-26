<?php

namespace App\Http\Livewire;
use App\Models\ChatModel;
use Livewire\Component;

class Chat extends Component
{
    public $chat;
    public function mount(){

        $this->chatdata();

    }

    public function chatdata(){

        $this->chat=ChatModel::latest()->get();

    }
    public function render()
    {
        return view('livewire.chat');
    }
}
