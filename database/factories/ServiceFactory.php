<?php

namespace Database\Factories;

use App\Models\Service;
use App\Models\Direction;
use Illuminate\Database\Eloquent\Factories\Factory;

class ServiceFactory extends Factory
{
    protected $model = Service::class;

    public function definition(): array
    {
        return [
            'nom' => $this->faker->companySuffix,
            'description' => $this->faker->sentence,
            'direction_id' => Direction::inRandomOrder()->first()?->id ?? null,
        ];
    }
}
