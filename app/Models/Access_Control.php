<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Access_Control extends Model
{
    use HasFactory;
    protected $table='access_control';
    protected $primaryKey='access_id';


    public function room()
    {
        return $this->belongsTo(RoomsModel::class);
    }
}