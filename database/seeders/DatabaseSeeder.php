<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ordre logique d'exécution des seeders
        $this->call([
            RoleSeeder::class,           // Crée les rôles (Admin, Formateur, Participant)
            DirectionSeeder::class,     // Crée les directions
            ServiceSeeder::class,       // Crée les services liés aux directions
            UsersSeeder::class,         // Crée les formateurs et participants
            FormationSeeder::class,     // Crée une formation liée à un service et à un formateur
            CommentsSeeder::class,      // Crée un commentaire lié à un utilisateur et une formation
            AttestationsSeeder::class,  // Crée des attestations pour des participants
            FormationUserSeeder::class, // 🔥 Associe formateurs et participants aux formations (via pivot)
        ]);
    }
}
