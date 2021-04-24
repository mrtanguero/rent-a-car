<?php

namespace Database\Seeders;

use App\Models\Reservation;
use Illuminate\Database\Seeder;

class ReservationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Reservation::create([
            'car_id' => 1,
            'client_id' => 1,
            'date_from' => '2021-04-29',
            'date_to' => '2021-05-01',
            'pickup_location_id' => 1,
            'return_location_id' => 1,
        ])->extras()->attach([1, 3]);

        Reservation::create([
            'car_id' => 2,
            'client_id' => 3,
            'date_from' => '2021-04-30',
            'date_to' => '2021-05-03',
            'pickup_location_id' => 3,
            'return_location_id' => 2,
        ])->extras()->attach([1]);

        Reservation::create([
            'car_id' => 3,
            'client_id' => 2,
            'date_from' => '2021-04-30',
            'date_to' => '2021-05-03',
            'pickup_location_id' => 4,
            'return_location_id' => 1,
        ])->extras()->attach([2, 3]);

        Reservation::create([
            'car_id' => 5,
            'client_id' => 5,
            'date_from' => '2021-05-01',
            'date_to' => '2021-05-05',
            'pickup_location_id' => 4,
            'return_location_id' => 1,
        ])->extras()->attach([1, 2, 3]);

        Reservation::create([
            'car_id' => 6,
            'client_id' => 4,
            'date_from' => '2021-05-01',
            'date_to' => '2021-05-05',
            'pickup_location_id' => 1,
            'return_location_id' => 1,
        ]);
    }
}
