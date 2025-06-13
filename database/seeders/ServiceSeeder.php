<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Service;
use App\Models\Direction;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        $direction = Direction::first(); // Assure-toi d'avoir au moins une direction

        $services = ['Informatique', 'RH', 'Comptabilité'];
        foreach ($services as $nom) {
            Service::create([
                'nom' => $nom,
                'description' => "Service de $nom",
                'direction_id' => $direction->id
            ]);
        }
    }
}
