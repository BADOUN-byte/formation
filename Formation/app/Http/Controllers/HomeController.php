<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; // ou ton propre modèle

class HomeController extends Controller
{
    /**
     * Affiche le tableau de bord avec la liste des utilisateurs.
     */
    public function index()
    {
        // Récupérer les utilisateurs avec pagination
        $users = User::paginate(10); // Tu peux ajuster à ton modèle

        // Retourner la vue avec les données
        return view('home', compact('users'));
    }
}
