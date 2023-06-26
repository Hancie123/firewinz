<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payments extends Model
{
    use HasFactory;
    protected $table='payments';
    protected $primaryKey='payment_id';

    public function room()
{
    return $this->belongsTo(RoomsModel::class, 'room_id');
}

    public function user()
    {
    return $this->belongsTo(Users::class, 'User_ID');
    }
    
}