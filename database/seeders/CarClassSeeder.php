<?php

namespace Database\Seeders;

use App\Models\CarClass;
use Illuminate\Database\Seeder;

class CarClassSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CarClass::create([
            'name' => 'Putnički'
        ]);
        CarClass::create([
            'name' => 'Sportski'
        ]);
        CarClass::create([
            'name' => 'Pickup'
        ]);
        CarClass::create([
            'name' => 'Terenac'
        ]);
    }
}
