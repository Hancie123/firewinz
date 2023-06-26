<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class rules_model extends Model
{
    protected $table="rules_regulations";
    protected $primaryKey="rules_id";
    
    use HasFactory;
}