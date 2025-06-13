<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Formation;
use App\Models\Service;
use App\Models\User;

class FormationSeeder extends Seeder
{
    public function run(): void
    {
        $service = Service::first();
        $formateur = User::where('role_id', \App\Models\Role::FORMATEUR)->first();

        Formation::create([
            'titre' => 'Formation Laravel',
            'description' => 'Introduction à Laravel 10',
            'type' => 'Présentiel',
            'date_debut' => now()->addDays(10),
            'date_fin' => now()->addDays(15),
            'volume_horaire' => 30,
            'lieu' => 'Salle A1',
            'formateur_id' => $formateur->id,
            'service_id' => $service->id,
        ]);
    }
}
