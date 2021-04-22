<?php

namespace Database\Seeders;

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
            LocationSeeder::class
        ]);
        // \App\Models\User::factory(10)->create();
        // \App\Models\Client::factory(50)->create();
        // \App\Models\Car::factory(10)->create();
        // \App\Models\Reservation::factory(50)->create();
    }
}
