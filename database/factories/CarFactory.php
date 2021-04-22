<?php

namespace Database\Factories;

use App\Models\Car;
use App\Models\CarClass;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CarFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Car::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->unique()->words(2, true),
            'plate_number' => Str::random(10),
            'production_year' => $this->faker->year(),
            'car_class_id' => CarClass::all()->random()->id,
            'number_of_seats' => $this->faker->numberBetween(2, 5),
            'price_per_day' => $this->faker->numberBetween(30, 100),
            'photo_url' => $this->faker->imageUrl(640, 480, 'cars', true, 'word?'),
            'additional_notes' => $this->faker->sentence(8)
        ];
    }
}
