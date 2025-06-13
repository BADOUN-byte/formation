<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Comment;
use App\Models\User;
use App\Models\Formation;

class CommentsSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::inRandomOrder()->first();
        $formation = Formation::first();

        Comment::create([
            'contenu' => 'Très bonne formation.',
            'user_id' => $user->id,
            'formation_id' => $formation->id,
        ]);
    }
}
