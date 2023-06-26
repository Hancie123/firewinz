<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product_Balance extends Model
{
    use HasFactory;
    protected $table='product_balance';
    protected $primaryKey='credit_id';

    public function product()
    {
        return $this->belongsTo(Products::class);
    }
}