<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }

    public function getFirstReservationAttribute()
    {
        $first_res_date = $this->reservations()->orderBy('created_at')->first();
        return $first_res_date ? $first_res_date->created_at : 'N/A';
    }

    public function getLastReservationAttribute()
    {
        $first_res_date = $this->reservations()->orderByDesc('created_at')->first();
        return $first_res_date ? $first_res_date->created_at : 'N/A';
    }
}
