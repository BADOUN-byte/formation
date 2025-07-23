<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class ProfileController extends Controller
{
    public function edit()
    {
        $user = Auth::user();
        return view('profile.edit', compact('user'));
    }

    public function update(Request $request): \Illuminate\Http\RedirectResponse
{
    $user = Auth::user();

    $request->validate([
        'nom' => 'required|string|max:255',
        'prenom' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,' . $user->id,
    ]);

    $user->update([
        'nom' => $request->nom,
        'prenom' => $request->prenom,
        'email' => $request->email,
    ]);

    return redirect()->route('admin.dashboard')->with('success', 'Profil mis à jour.');
}


    public function toggle($id)
    {
        $user = User::findOrFail($id);
        $user->actif = !$user->actif;
        $user->save();

        return back()->with('success', 'Statut du profil mis à jour.');
    }
}
