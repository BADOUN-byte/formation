<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Direction;

class DirectionSeeder extends Seeder
{
    public function run(): void
    {
        $noms = ['DGTI', 'DESF', 'DASP', 'DSI', 'DT', 'DIG'];

        foreach ($noms as $nom) {
            Direction::updateOrCreate(['nom' => $nom]);
        }
    }
}
