<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment_Balance extends Model
{
    use HasFactory;
    protected $table='payment_balance';
    protected $primaryKey='cash_id';
}