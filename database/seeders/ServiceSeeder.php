<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Service;
use App\Models\Direction;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        $direction = Direction::first();

        if (!$direction) {
            $this->command->error('❌ Aucun direction trouvé. Veuillez d\'abord exécuter le seeder des directions.');
            return;
        }

        $services = ['Informatique', 'RH', 'Comptabilité'];

        foreach ($services as $nom) {
            $service = Service::updateOrCreate(
                ['nom' => $nom, 'direction_id' => $direction->id],
                ['description' => "Service de $nom"]
            );

            $status = $service->wasRecentlyCreated ? '✅ Créé' : '🔁 Mis à jour';
            $this->command->info("$status : service $nom");
        }
    }
}
