<?php

namespace Database\Seeders;

use App\Models\Extra;
use Illuminate\Database\Seeder;

class ExtraSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Extra::create([
            'name' => 'Sjedište za bebu'
        ]);
        Extra::create([
            'name' => 'GPS uređaj'
        ]);
        Extra::create([
            'name' => 'Zimska oprema'
        ]);
    }
}
