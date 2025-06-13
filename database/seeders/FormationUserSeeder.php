<?php


namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Formation;
use App\Models\User;
use App\Models\FormationUser;

class FormationUserSeeder extends Seeder
{
    public function run(): void
    {
        $formations = Formation::all();
        $formateurs = User::where('role_id', \App\Models\Role::FORMATEUR)->get();
        $participants = User::where('role_id', \App\Models\Role::PARTICIPANT)->get();

        foreach ($formations as $formation) {
            // Affecter un formateur aléatoire à chaque formation
            if ($formateurs->isNotEmpty()) {
                $formateur = $formateurs->random();
                FormationUser::create([
                    'formation_id' => $formation->id,
                    'user_id' => $formateur->id,
                    'role_in_formation' => 'formateur',
                ]);
            }

            // Ajouter 3 à 6 participants aléatoires
            $randomParticipants = $participants->random(rand(3, 6));
            foreach ($randomParticipants as $participant) {
                FormationUser::create([
                    'formation_id' => $formation->id,
                    'user_id' => $participant->id,
                    'role_in_formation' => 'participant',
                ]);
            }
        }
}
        
}