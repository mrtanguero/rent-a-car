<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarClass extends Model
{
    use HasFactory;

    protected $fillable = ["name"];

    public function car()
    {
        return $this->hasMany(Car::class);
    }
}
