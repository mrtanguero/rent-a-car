<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function extras()
    {
        return $this->belongsToMany(Extra::class)->withTimestamps();
    }

    public function car()
    {
        return $this->belongsTo(Car::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function pickup_location()
    {
        return $this->belongsTo(Location::class, 'pickup_location_id');
    }

    public function return_location()
    {
        return $this->belongsTo(Location::class, 'return_location_id');
    }
}
