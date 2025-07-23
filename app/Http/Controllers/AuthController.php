<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Affiche le formulaire de connexion
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Traite la connexion
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $user = Auth::user();

            // Redirection en fonction du rôle
            switch ($user->role->nom) {
                case 'admin':
                    return redirect()->route('admin.dashboard');
                case 'formateur':
                    return redirect()->route('dashboard');
                default:
                    return redirect()->route('home');
            }
        }

        return back()->withErrors([
            'email' => 'Adresse e-mail ou mot de passe incorrect.',
        ])->onlyInput('email');
    }

    /**
     * Déconnecte l'utilisateur
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
