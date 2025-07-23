<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use App\Models\Role;
use App\Models\Service;

class UserFactory extends Factory
{
    protected $model = \App\Models\User::class;

    public function definition()
    {
        $service = Service::inRandomOrder()->first();

        return [
            'nom' => $this->faker->lastName(),
            'prenom' => $this->faker->firstName(),
            'email' => $this->faker->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => Hash::make('password'), // mot de passe par défaut hashé
            'matricule' => strtoupper(Str::random(6)),
            'grade' => $this->faker->randomElement(['Débutant', 'Intermédiaire', 'Avancé']),
            'fonction' => $this->faker->jobTitle(),
            'role_id' => Role::PARTICIPANT, // valeur par défaut
            'service_id' => $service ? $service->id : null,
            'remember_token' => Str::random(10),
        ];
    }

    // State admin
    public function admin()
    {
        return $this->state(function (array $attributes) {
            return [
                'role_id' => Role::ADMIN,
                'grade' => 'Administrateur',
                'fonction' => 'Admin Système',
            ];
        });
    }

    // State formateur
    public function formateur()
    {
        return $this->state(function (array $attributes) {
            return [
                'role_id' => Role::FORMATEUR,
                'grade' => 'Formateur',
                'fonction' => 'Formateur',
            ];
        });
    }

    // State participant
    public function participant()
    {
        return $this->state(function (array $attributes) {
            return [
                'role_id' => Role::PARTICIPANT,
                'grade' => 'Participant',
                'fonction' => 'Participant',
            ];
        });
    }
}
