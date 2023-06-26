<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShiftModel extends Model
{
    use HasFactory;
    protected $table='shift';
    protected $primaryKey='shift_id';

    public function room()
    {
        return $this->belongsTo(RoomsModel::class);
    }

    public function user()
    {
        return $this->belongsTo(Users::class);
    }
}