<?php

namespace Database\Factories;

use App\Models\Car;
use App\Models\Client;
use App\Models\Location;
use App\Models\Reservation;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReservationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Reservation::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'date_from' => $this->faker->date(),
            'date_to' => $this->faker->date(),
            'car_id' => Car::all()->random()->id,
            'client_id' => Client::all()->random()->id,
            'pickup_location_id' => Location::all()->random()->id,
            'return_location_id' => Location::all()->random()->id,
        ];
    }
}
