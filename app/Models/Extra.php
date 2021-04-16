<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Extra extends Model
{
    use HasFactory;

    protected $fillable = ["name"];

    public function reservations()
    {
        return $this->belongsToMany(Reservation::class)->withTimestamps();
    }
}
