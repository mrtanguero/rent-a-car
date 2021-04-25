<?php

namespace Database\Seeders;

use App\Models\Reservation;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            CountrySeeder::class,
            CarClassSeeder::class,
            ExtraSeeder::class,
            LocationSeeder::class,
            // CarSeeder::class,
            // ClientSeeder::class,
            // ReservationSeeder::class
        ]);
        // \App\Models\User::factory(10)->create();
        // \App\Models\Client::factory(50)->create();
        // \App\Models\Car::factory(15)->create();
        // \App\Models\Reservation::factory(50)->create();
    }
}
