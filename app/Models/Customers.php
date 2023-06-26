<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customers extends Model
{
    use HasFactory;
    protected $table='customers';
    protected $primaryKey='customer_id';

    public function user()
    {
        return $this->belongsTo(Users::class, 'User_ID');
    }

    public function room()
    {
        return $this->belongsTo(RoomsModel::class, 'room_id');
    }
}