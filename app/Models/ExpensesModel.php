<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExpensesModel extends Model
{
    use HasFactory;
    protected $table='expenses';
    protected $primaryKey='expenses_id';


    public function user()
    {
        return $this->belongsTo(Users::class);
    }
}