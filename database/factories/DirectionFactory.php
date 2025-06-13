<?php

namespace Database\Factories;

use App\Models\Direction;
use Illuminate\Database\Eloquent\Factories\Factory;

class DirectionFactory extends Factory
{
    protected $model = Direction::class;

    public function definition(): array
    {
        return [
            'nom' => $this->faker->unique()->company,
        ];
    }
}
