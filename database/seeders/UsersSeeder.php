<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Service;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\Role;

class UsersSeeder extends Seeder
{
    public function run(): void
    {
        $service = Service::first();

        if (!$service) {
            $this->command->error('❌ Aucun service trouvé. Veuillez d\'abord exécuter le seeder des services.');
            return;
        }

        // Crée l'admin uniquement s'il n'existe pas
        $admin = User::firstOrCreate(
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
                'remember_token' => Str::random(10),
            ]
        );

        if ($admin->wasRecentlyCreated) {
            $this->command->info('✅ Admin créé avec succès (admin@dgti.local)');
        } else {
            $this->command->warn('⚠️ Admin déjà existant (admin@dgti.local)');
        }

        // Crée 3 formateurs (sauf s’ils existent déjà pour éviter doublons)
        User::factory()->count(3)->create([
            'role_id' => Role::FORMATEUR,
            'service_id' => $service->id,
        ]);

        // Crée 10 participants
        User::factory()->count(10)->create([
            'role_id' => Role::PARTICIPANT,
            'service_id' => $service->id,
        ]);

        $this->command->info('✅ Formateurs et participants créés.');
    }
}
