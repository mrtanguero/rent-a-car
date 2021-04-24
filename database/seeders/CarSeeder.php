<?php

namespace Database\Seeders;

use App\Models\Car;
use Illuminate\Database\Seeder;

class CarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Car::create([
            'name' => 'Golf IV',
            'plate_number' => 'PG DU999',
            'production_year' => 2000,
            'car_class_id' => 1,
            'number_of_seats' => 4,
            'price_per_day' => 30,
            'photo_url' => 'car-images/d8jWvZH2vLVl07CrjeEgTj48dfWJWhEtP0BT4QHY.jpg',
            'additional_notes' => 'Moj Golf stari, nikad se ne kvari.'
        ]);

        Car::create([
            'name' => 'Ferrari F8 Tributo',
            'plate_number' => 'PG DA111',
            'production_year' => 2020,
            'car_class_id' => 2,
            'number_of_seats' => 2,
            'price_per_day' => 100,
            'photo_url' => 'car-images/WJnqBSbY4Xv4abDVPPp4OcC0Z0aTNXVeBX92urYg.jpg',
        ]);

        Car::create([
            'name' => 'Fića',
            'plate_number' => 'PG KM987',
            'production_year' => 1970,
            'car_class_id' => 1,
            'number_of_seats' => 4,
            'price_per_day' => 50,
            'photo_url' => 'car-images/HEkPSmgVY4RRkiUmq3mC6S14Jgoxev8VUuwWuG7F.jpg',
            'additional_notes' => 'Legenda živi i dalje.'
        ]);

        Car::create([
            'name' => 'Honda Acord',
            'plate_number' => 'BD NM231',
            'production_year' => 2019,
            'car_class_id' => 1,
            'number_of_seats' => 4,
            'price_per_day' => 60,
            'photo_url' => 'car-images/mg5Dsm8jFmy4jA4XGPxn8R2w5KWKl6OpdKHwcfAV.jpg',
            'additional_notes' => 'Skupi djelovi.'
        ]);

        Car::create([
            'name' => 'Kia Optima',
            'plate_number' => 'NK KL231',
            'production_year' => 2019,
            'car_class_id' => 1,
            'number_of_seats' => 4,
            'price_per_day' => 60,
            'photo_url' => 'car-images/aTqg6v0e2Z2xflWaDmwDQWE1eauvgoOc2GbYJt2a.jpg',
        ]);

        Car::create([
            'name' => 'Lamborghini Urus',
            'plate_number' => 'PG KO221',
            'production_year' => 2019,
            'car_class_id' => 3,
            'number_of_seats' => 5,
            'price_per_day' => 80,
            'photo_url' => 'car-images/Sk4Kwub0KRQ3zWZSlf28KSHUcGVSF0IUMU8VdCQY.jpg',
        ]);

        Car::create([
            'name' => 'Jeep Wrangler',
            'plate_number' => 'NK BV001',
            'production_year' => 2018,
            'car_class_id' => 4,
            'number_of_seats' => 4,
            'price_per_day' => 85,
            'photo_url' => 'car-images/qAtAcGVHcjt3HGEPq3EgAHDLIUx3XJnzaPxKHo2L.jpg',
        ]);
    }
}
