<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use App\Models\Service;
use App\Models\Formation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Liste tous les utilisateurs
    public function index()
    {
        $users = User::with(['role', 'service'])->get();
        $roleId = auth()->user()->role_id;

        return view('users.index', compact('users', 'roleId'));
    }

    // Formulaire de création
    public function create()
    {
        $roles = Role::all();
        $services = Service::all();
        return view('users.create', compact('roles', 'services'));
    }

    // Création d’un nouvel utilisateur
    public function store(Request $request)
    {
        $request->validate([
            'nom'        => 'required|string',
            'prenom'     => 'required|string',
            'email'      => 'required|email|unique:users,email',
            'password'   => 'required|min:6',
            'role_id'    => 'required|exists:roles,id',
            'matricule'  => 'nullable|string',
            'grade'      => 'nullable|string',
            'fonction'   => 'nullable|string',
            'service_id' => 'nullable|exists:services,id',
        ]);

        User::create([
            'nom'        => $request->nom,
            'prenom'     => $request->prenom,
            'email'      => $request->email,
            'password'   => Hash::make($request->password),
            'matricule'  => $request->matricule,
            'grade'      => $request->grade,
            'fonction'   => $request->fonction,
            'role_id'    => $request->role_id,
            'service_id' => $request->service_id,
        ]);

        return redirect()->route('dashboard')->with('success', 'Utilisateur créé avec succès.');
    }

    // Formulaire d’édition
    public function edit(User $user)
    {
        $roles = Role::all();
        $services = Service::all();
        return view('users.edit', compact('user', 'roles', 'services'));
    }

    // Mise à jour d’un utilisateur
    public function update(Request $request, User $user)
    {
        $request->validate([
            'nom'        => 'required|string',
            'prenom'     => 'required|string',
            'email'      => 'required|email|unique:users,email,' . $user->id,
            'password'   => 'nullable|min:6',
            'role_id'    => 'required|exists:roles,id',
            'matricule'  => 'nullable|string',
            'grade'      => 'nullable|string',
            'fonction'   => 'nullable|string',
            'service_id' => 'nullable|exists:services,id',
        ]);

        $data = $request->only([
            'nom', 'prenom', 'email', 'matricule', 'grade', 'fonction', 'role_id', 'service_id'
        ]);

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect()->route('dashboard')->with('success', 'Utilisateur mis à jour avec succès.');
    }

    // Affiche un utilisateur
    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    // Suppression d’un utilisateur
    public function destroy(User $user)
    {
        // Bloquer la suppression d’un admin ou de soi-même
        if ($user->role_id === Role::ADMIN) {
            return redirect()->route('dashboard')->with('error', 'Impossible de supprimer un administrateur.');
        }

        if (auth()->id() === $user->id) {
            return redirect()->route('dashboard')->with('error', 'Vous ne pouvez pas supprimer votre propre compte.');
        }

        $user->delete();
        return redirect()->route('dashboard')->with('success', 'Utilisateur supprimé avec succès.');
    }

    // Affiche le tableau de bord selon le rôle
    public function dashboard()
    {
        $user = auth()->user();

        if (!$user) {
            return redirect()->route('login')->with('error', 'Veuillez vous connecter.');
        }

        switch ($user->role_id) {
            case Role::ADMIN:
                $users      = User::with('role')->get();
                $services   = Service::all();
                $formateurs = $users->where('role_id', Role::FORMATEUR);
                $formations = Formation::all();

                return view('users.admin.dashboard', compact('users', 'services', 'formateurs', 'formations'));

            case Role::FORMATEUR:
                $formations = Formation::where('formateur_id', $user->id)->get();
                return view('users.formateur.dashboard', compact('formations'));

            case Role::PARTICIPANT:
                $formations = $user->formationsParticipant ?? collect();
                return view('users.participant.dashboard', compact('formations'));

            default:
                return redirect()->route('login')->with('error', 'Rôle non reconnu.');
        }
    }
}
