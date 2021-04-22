<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Seeder;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Country::create([
            'name' => 'Crna Gora'
        ]);
        Country::create([
            'name' => 'Srbija'
        ]);
        Country::create([
            'name' => 'Hrvatska'
        ]);
        Country::create([
            'name' => 'Albanija'
        ]);
        Country::create([
            'name' => 'Slovenija'
        ]);
    }
}
