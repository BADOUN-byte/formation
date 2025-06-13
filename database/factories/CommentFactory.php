<?php

namespace Database\Factories;

use App\Models\Comment;
use App\Models\User;
use App\Models\Formation;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommentFactory extends Factory
{
    protected $model = Comment::class;

    public function definition(): array
    {
        return [
            'contenu' => $this->faker->sentence,
            'user_id' => User::inRandomOrder()->first()?->id,
            'formation_id' => Formation::inRandomOrder()->first()?->id,
        ];
    }
}
