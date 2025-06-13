<?php

namespace Database\Factories;

use App\Models\Formation;
use App\Models\Role;
use App\Models\User;
use App\Models\Service;
use Illuminate\Database\Eloquent\Factories\Factory;

class FormationFactory extends Factory
{
    protected $model = Formation::class;

    public function definition(): array
    {
        // Générer une date_debut entre maintenant et dans 1 mois
        $date_debut = $this->faker->dateTimeBetween('now', '+1 month');

        // date_fin est après date_debut, entre date_debut et date_debut + 1 mois
        $date_fin = $this->faker->dateTimeBetween($date_debut, $date_debut->format('Y-m-d H:i:s') . ' +1 month');

        return [
            'titre' => $this->faker->sentence(4),
            'description' => $this->faker->paragraph,
            'type' => $this->faker->randomElement(['Présentiel', 'En ligne', 'Hybride']),
            'date_debut' => $date_debut,
            'date_fin' => $date_fin,
            'lieu' => $this->faker->city,
            'volume_horaire' => $this->faker->numberBetween(1, 40),
            'statut' => $this->faker->randomElement(['en cours', 'terminée', 'annulée']),
            'formateur_id' => User::where('role_id', Role::FORMATEUR)->inRandomOrder()->first()?->id ?? User::factory(),
            'service_id' => Service::inRandomOrder()->first()?->id ?? Service::factory(),
        ];
    }
}
