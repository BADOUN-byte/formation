<?php

namespace Database\Factories;

use App\Models\Attestation;
use App\Models\User;
use App\Models\Formation;
use Illuminate\Database\Eloquent\Factories\Factory;

class AttestationFactory extends Factory
{
    protected $model = Attestation::class;

    public function definition(): array
    {
        return [
            'user_id' => User::inRandomOrder()->first()?->id,
            'formation_id' => Formation::inRandomOrder()->first()?->id,
            'date_delivrance' => $this->faker->date(),
            'fichier_pdf' => 'attestations/' . $this->faker->uuid . '.pdf',
             // génère un chemin fictif
        ];
    }
}
