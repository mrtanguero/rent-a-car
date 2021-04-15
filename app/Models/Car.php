<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;

    public function car_class()
    {
        return $this->belongsTo(CarClass::class);
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
}
