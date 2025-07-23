<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Formation;
use App\Models\Service;
use App\Models\User;
use App\Models\Role;

class FormationSeeder extends Seeder
{
    public function run(): void
    {
        $service = Service::first();
        $formateur = User::where('role_id', Role::FORMATEUR)->first();

        if (!$service) {
            $this->command->error('❌ Aucun service trouvé. Veuillez exécuter le seeder des services.');
            return;
        }

        if (!$formateur) {
            $this->command->error('❌ Aucun formateur trouvé. Veuillez exécuter le seeder des utilisateurs avec des formateurs.');
            return;
        }

        if (!$service->direction_id) {
            $this->command->error('❌ Le service sélectionné n\'a pas de direction associée.');
            return;
        }

        Formation::create([
            'titre' => 'Formation Laravel',
            'description' => 'Introduction à Laravel 10',
            'type' => 'présentiel',
            'date_debut' => now()->addDays(10),
            'date_fin' => now()->addDays(15),
            'volume_horaire' => 30,
            'lieu' => 'Salle A1',
            'formateur_id' => $formateur->id,
            'service_id' => $service->id,
            'direction_id' => $service->direction_id,
        ]);

        $this->command->info('✅ Formation Laravel créée avec direction.');
    }
}
