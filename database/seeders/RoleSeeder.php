<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        // Tableau des rôles avec ID fixés
        $roles = [
            Role::ADMIN => 'admin',
            Role::FORMATEUR => 'formateur',
            Role::PARTICIPANT => 'participant',
        ];

        foreach ($roles as $id => $nom) {
            $role = Role::updateOrCreate(
                ['id' => $id],             // Forcer l'ID
                ['nom' => $nom]            // Met à jour le nom si nécessaire
            );

            $status = $role->wasRecentlyCreated ? '✅ Créé' : '🔁 Mis à jour';
            $this->command->info("[$status] Rôle ID: $id → $nom");
        }
    }
}
