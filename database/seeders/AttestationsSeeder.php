<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Attestation;
use App\Models\User;
use App\Models\Formation;

class AttestationsSeeder extends Seeder
{
    public function run(): void
    {
        $participants = User::where('role_id', \App\Models\Role::PARTICIPANT)->take(3)->get();
        $formation = Formation::first();

        foreach ($participants as $user) {
            Attestation::create([
                'user_id' => $user->id,
                'formation_id' => $formation->id,
                'date_delivrance' => now(),
                'fichier_pdf' => 'attestations/' . $user->id . '.pdf',
            ]);
        }
    }
}
