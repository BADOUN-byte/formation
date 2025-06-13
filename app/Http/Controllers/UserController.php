<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use App\Models\Service;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // Si tu veux restreindre l'accès à certains rôles
    // public function __construct()
    // {
    //     $this->middleware('can:manage-users'); // ou ton propre middleware
    // }

    public function index()
    {
        $users = User::with(['role', 'service'])->get();
        return view('users.index', compact('users'));
    }

    public function create()
    {
        $roles = Role::all();
        $services = Service::all();
        return view('users.create', compact('roles', 'services'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string',
            'prenom' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'role_id' => 'required|exists:roles,id',
            'matricule' => 'nullable|string',
            'grade' => 'nullable|string',
            'fonction' => 'nullable|string',
            'service_id' => 'nullable|exists:services,id',
        ]);

        User::create([
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'matricule' => $request->matricule,
            'grade' => $request->grade,
            'fonction' => $request->fonction,
            'role_id' => $request->role_id,
            'service_id' => $request->service_id,
        ]);

        return redirect()->route('users.index')->with('success', 'Utilisateur créé avec succès.');
    }

    public function edit(User $user)
    {
        $roles = Role::all();
        $services = Service::all();
        return view('users.edit', compact('user', 'roles', 'services'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'nom' => 'required|string',
            'prenom' => 'required|string',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|min:6',
            'role_id' => 'required|exists:roles,id',
            'matricule' => 'nullable|string',
            'grade' => 'nullable|string',
            'fonction' => 'nullable|string',
            'service_id' => 'nullable|exists:services,id',
        ]);

        $user->update([
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'email' => $request->email,
            'matricule' => $request->matricule,
            'grade' => $request->grade,
            'fonction' => $request->fonction,
            'role_id' => $request->role_id,
            'service_id' => $request->service_id,
        ]);

        // Mise à jour du mot de passe si fourni
        if ($request->filled('password')) {
            $user->update(['password' => Hash::make($request->password)]);
        }

        return redirect()->route('users.index')->with('success', 'Utilisateur mis à jour avec succès.');
    }

    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with('success', 'Utilisateur supprimé.');
    }
}
