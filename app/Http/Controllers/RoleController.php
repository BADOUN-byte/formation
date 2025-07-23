<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    // Affiche la liste des rôles
    public function index()
    {
        $roles = Role::all();
        return view('roles.index', compact('roles'));
    }

    // Affiche le formulaire pour créer un nouveau rôle
    public function create()
    {
        return view('roles.create');
    }

    // Enregistre un nouveau rôle en base
    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255|unique:roles,nom',
        ]);

        Role::create([
            'nom' => $request->nom,
        ]);

        return redirect()->route('roles.index')
                         ->with('success', 'Rôle créé avec succès.');
    }

    // Affiche le formulaire pour éditer un rôle
    public function edit(Role $role)
    {
        return view('roles.edit', compact('role'));
    }

    // Met à jour un rôle en base
    public function update(Request $request, Role $role)
    {
        $request->validate([
            'nom' => 'required|string|max:255|unique:roles,nom,' . $role->id,
        ]);

        $role->update([
            'nom' => $request->nom,
        ]);

        return redirect()->route('roles.index')
                         ->with('success', 'Rôle mis à jour avec succès.');
    }

    // Supprime un rôle
    public function destroy(Role $role)
    {
        $role->delete();

        return redirect()->route('roles.index')
                         ->with('success', 'Rôle supprimé avec succès.');
    }
}
