<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Service;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UsersSeeder extends Seeder
{
    public function run(): void
    {
        // Vérifie que les rôles nécessaires existent
        if (!Role::find(Role::ADMIN) || !Role::find(Role::FORMATEUR) || !Role::find(Role::PARTICIPANT)) {
            $this->command->error('❌ Rôles manquants. Veuillez exécuter d\'abord le RoleSeeder.');
            return;
        }

        // Vérifie qu’un service existe
        $service = Service::first();
        if (!$service) {
            $this->command->error('❌ Aucun service trouvé. Veuillez d\'abord exécuter le ServiceSeeder.');
            return;
        }

        // Crée ou met à jour l'admin
        $admin = User::updateOrCreate(
            ['email' => 'admin@dgti.local'],
            [
                'nom' => 'Admin',
                'prenom' => 'Système',
                'email_verified_at' => now(),
                'password' => Hash::make('admin123'),
                'matricule' => strtoupper(Str::random(6)),
                'grade' => 'Intermédiaire',
                'fonction' => 'Administrateur',
                'role_id' => Role::ADMIN,
                'service_id' => $service->id,
                'is_active' => true,
                'remember_token' => Str::random(10),
            ]
        );

        if ($admin->wasRecentlyCreated) {
            $this->command->info('✅ Admin créé : admin@dgti.local / admin123');
        } else {
            $this->command->warn('⚠️ Admin existant mis à jour : admin@dgti.local');
        }

        // Crée les formateurs manquants
        $formateurCount = User::where('role_id', Role::FORMATEUR)->count();
        $missingFormateurs = 3 - $formateurCount;

        if ($missingFormateurs > 0) {
            User::factory()
                ->count($missingFormateurs)
                ->formateur()
                ->create([
                    'service_id' => $service->id,
                    'is_active' => true,
                ]);

            $this->command->info("✅ $missingFormateurs formateur(s) créé(s).");
        } else {
            $this->command->warn("⚠️ $formateurCount formateur(s) déjà existant(s).");
        }

        // Crée les participants manquants
        $participantCount = User::where('role_id', Role::PARTICIPANT)->count();
        $missingParticipants = 10 - $participantCount;

        if ($missingParticipants > 0) {
            User::factory()
                ->count($missingParticipants)
                ->participant()
                ->create([
                    'service_id' => $service->id,
                    'is_active' => true,
                ]);

            $this->command->info("✅ $missingParticipants participant(s) créé(s).");
        } else {
            $this->command->warn("⚠️ $participantCount participant(s) déjà existant(s).");
        }
    }
}
