<?php

namespace Database\Seeders;

use App\Models\Location;
use Illuminate\Database\Seeder;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Location::create([
            'name' => 'Aerodrom Podgorica'
        ]);
        Location::create([
            'name' => 'Aerodrom Tivat'
        ]);
        Location::create([
            'name' => 'Podgorica - Centar'
        ]);
        Location::create([
            'name' => 'Poslovnica Nikšić'
        ]);
        Location::create([
            'name' => 'Poslovnica Bijelo Polje'
        ]);
    }
}
