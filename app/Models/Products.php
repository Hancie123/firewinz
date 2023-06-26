<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;
    protected $table='products';
    protected $primaryKey='product_id';

    

    public function room()
{
    return $this->belongsTo(RoomsModel::class);
}

}