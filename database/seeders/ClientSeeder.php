<?php

namespace Database\Seeders;

use App\Models\Client;
use Illuminate\Database\Seeder;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Client::create([
            'name' => 'Darko Marković',
            'country_id' => 1,
            'id_document_number' => 'ME12345678',
            'email' => 'darko@mail.com',
            'phone' => '067 278343',
            'additional_notes' => 'Evo da ima nešto i ovdje'
        ]);
        Client::create([
            'name' => 'Milica Marković',
            'country_id' => 2,
            'id_document_number' => 'SR12345678',
            'email' => 'milica@mail.com',
            'phone' => '+381 65 287456',
            'additional_notes' => 'Jedna u majke!'
        ]);
        Client::create([
            'name' => 'Dragica Mirković',
            'country_id' => 2,
            'id_document_number' => 'SR24545678',
            'email' => 'mirkovicka@mail.com',
            'phone' => '+381 66 278343',
        ]);
        Client::create([
            'name' => 'Enes Begović',
            'country_id' => 1,
            'id_document_number' => 'ME87631678',
            'email' => 'enes@mail.com',
            'phone' => '067 876123',
        ]);
        Client::create([
            'name' => 'Marina Dragaš',
            'country_id' => 3,
            'id_document_number' => 'HR22345678',
            'email' => 'marina@mail.com',
            'phone' => '+385 66 278343',
        ]);
    }
}
