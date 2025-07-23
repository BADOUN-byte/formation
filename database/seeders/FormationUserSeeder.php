<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Formation;
use App\Models\User;

class FormationUserSeeder extends Seeder
{
    public function run(): void
    {
        $formations = Formation::all();
        $formateurs = User::where('role_id', \App\Models\Role::FORMATEUR)->get();
        $participants = User::where('role_id', \App\Models\Role::PARTICIPANT)->get();

        foreach ($formations as $formation) {
            // Affecter un formateur aléatoire à chaque formation, s’il y en a
            if ($formateurs->isNotEmpty()) {
                $formateur = $formateurs->random();

                // Attach formateur avec pivot
                $formation->users()->syncWithoutDetaching([
                    $formateur->id => ['role_in_formation' => 'formateur']
                ]);
            }

            // Nombre de participants à affecter, limité à la taille dispo
            $nbParticipants = min(rand(3, 6), $participants->count());

            if ($nbParticipants > 0) {
                $randomParticipants = $participants->random($nbParticipants);

                foreach ($randomParticipants as $participant) {
                    $formation->users()->syncWithoutDetaching([
                        $participant->id => ['role_in_formation' => 'participant']
                    ]);
                }
            }
        }
    }
}
