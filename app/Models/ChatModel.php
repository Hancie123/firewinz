<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatModel extends Model
{
    use HasFactory;
    protected $table='chat';
    protected $primaryKey='chat_id';

    public function user()
    {
        return $this->belongsTo(Users::class);
    }

    public function isUserOnline()
    {
        return $this->user->online;
    }
}