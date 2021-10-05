<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supply extends Model
{
    use HasFactory;

    protected $fillable = [
        'km', 
        'price', 
        'liters', 
        'total', 
        'date', 
        'vehicle_id'
    ];
}
