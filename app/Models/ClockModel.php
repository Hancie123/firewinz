<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClockModel extends Model
{
    use HasFactory;
    protected $table='clock';
    protected $primaryKey='clock_id';
}