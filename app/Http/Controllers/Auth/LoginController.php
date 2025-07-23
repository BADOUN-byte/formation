<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Role;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Affiche le formulaire de connexion.
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Traite la tentative de connexion.
     */
    public function login(Request $request)
    {
        // Validation des données
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Vérifie si l'utilisateur existe
        $user = User::where('email', $credentials['email'])->first();

        if (!$user) {
            return back()->withErrors([
                'email' => 'Aucun compte ne correspond à cet email.',
            ])->withInput();
        }

        // Vérifie si l'utilisateur est actif
        if (!$user->is_active) {
            return back()->withErrors([
                'email' => 'Votre compte est désactivé. Veuillez contacter l’administrateur.',
            ])->withInput();
        }

        // Tentative d'authentification
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // Redirection personnalisée selon le rôle
            $user = Auth::user();

            switch ($user->role_id) {
                case Role::ADMIN:
                    return redirect()->route('admin.dashboard');

                case Role::FORMATEUR:
                    return redirect()->route('dashboard'); // ou une route formateur dédiée

                case Role::PARTICIPANT:
                    return redirect()->route('dashboard'); // ou une route participant dédiée

                default:
                    Auth::logout();
                    return redirect()->route('login')->withErrors([
                        'email' => 'Rôle non autorisé.',
                    ]);
            }
        }

        return back()->withErrors([
            'email' => 'Les informations fournies sont incorrectes.',
        ])->withInput();
    }

    /**
     * Déconnecte l'utilisateur.
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('welcome');
    }
}
