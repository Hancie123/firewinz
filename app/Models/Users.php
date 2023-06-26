<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    use HasFactory;

    protected $table='users';
    protected $primaryKey='User_ID';

    public function rooms()
    {
        return $this->hasMany(RoomsModel::class, 'User_ID');
    }


    public function customers()
    {
        return $this->hasMany(Customers::class, 'User_ID');
    }


    public function payments()
    {
    return $this->hasMany(Payments::class, 'User_ID');
    }

    public function chat()
    {
        return $this->hasMany(ChatModel::class);
    }

    public function setOnlineStatus($status)
    {
        $this->online = $status;
        $this->save();
    }

}