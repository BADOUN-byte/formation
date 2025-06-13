<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Formation;
use Illuminate\Http\Request;

class FormationUserController extends Controller
{
    // Formulaire d'attachement
    public function attachForm(User $user)
    {
        $formations = Formation::all();
        return view('formation_user.attach', compact('user', 'formations'));
    }

    // Attacher une formation avec un rôle
    public function attach(Request $request, User $user)
    {
        $validated = $request->validate([
            'formation_id' => ['required', 'integer', 'exists:formations,id'],
            'role_in_formation' => ['required', 'string', 'in:formateur,participant'],
        ]);

        $user->formations()->syncWithoutDetaching([
            $validated['formation_id'] => ['role_in_formation' => $validated['role_in_formation']]
        ]);

        return redirect()->back()->with('success', 'Formation ajoutée à l\'utilisateur.');
    }

    // Détacher une formation
    public function detach(Request $request, User $user)
    {
        $request->validate([
            'formation_id' => ['required', 'integer', 'exists:formations,id'],
        ]);

        $user->formations()->detach($request->formation_id);

        return redirect()->back()->with('success', 'Formation détachée de l\'utilisateur.');
    }

    // Formulaire pour modifier le rôle dans la formation
    public function edit(User $user, Formation $formation)
    {
        $pivot = $user->formations()->where('formation_id', $formation->id)->firstOrFail()->pivot;

        return view('formation_user.edit', [
            'user' => $user,
            'formation' => $formation,
            'role_in_formation' => $pivot->role_in_formation,
        ]);
    }

    // Met à jour le rôle d’un utilisateur dans une formation
    public function update(Request $request, User $user, Formation $formation)
    {
        $request->validate([
            'role_in_formation' => ['required', 'in:formateur,participant'],
        ]);

        $user->formations()->updateExistingPivot($formation->id, [
            'role_in_formation' => $request->role_in_formation,
        ]);

        return redirect()->route('users.show', $user)->with('success', 'Rôle mis à jour avec succès.');
    }
}
