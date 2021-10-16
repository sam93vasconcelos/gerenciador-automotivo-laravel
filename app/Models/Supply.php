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

    public function setKmAttribute($value)
    {
        $this->attributes['km'] = str_replace(',','.',$value);
    }

    public function setPriceAttribute($value)
    {
        $this->attributes['price'] = str_replace(',','.',$value);
    }

    public function setLitersAttribute($value)
    {
        $this->attributes['liters'] = str_replace(',','.',$value);
    }

    public function setTotalAttribute($value)
    {
        $this->attributes['total'] = str_replace(',','.',$value);
    }
}
