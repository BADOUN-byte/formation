<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Role;
use App\Models\Service;

class UserFactory extends Factory
{
    protected $model = \App\Models\User::class;

    public function definition()
    {
        return [
            'nom' => $this->faker->lastName(),
            'prenom' => $this->faker->firstName(),
            'email' => $this->faker->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => bcrypt('password'), // mot de passe par défaut
            'matricule' => strtoupper(Str::random(6)),
            'grade' => $this->faker->randomElement(['Débutant', 'Intermédiaire', 'Avancé']),
            'fonction' => $this->faker->jobTitle(),
            'role_id' => Role::PARTICIPANT, // valeur par défaut, sera écrasée dans le seeder
            'service_id' => Service::inRandomOrder()->first()->id ?? null,
            'remember_token' => Str::random(10),
        ];
    }
}
