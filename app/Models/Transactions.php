<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transactions extends Model
{
    use HasFactory;

    protected $table='transactions';
    protected $primaryKey='transaction_id';

    public function room()
    {
        return $this->belongsTo(RoomsModel::class);
    }

    public function user()
    {
        return $this->belongsTo(Users::class, 'User_ID');
    }

    public function customer()
    {
        return $this->belongsTo(Customers::class);
    }

    public function product()
    {
        return $this->belongsTo(Products::class);
    }

    public function payment()
    {
        return $this->belongsTo(Payments::class);
    }
}