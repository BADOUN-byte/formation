<?php

namespace App\Http\Controllers;

use App\Models\Direction;
use App\Models\Formation;
use App\Models\User;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only(['home', 'dashboard']);
    }

    // 🌐 Page publique
    public function index()
    {
        // Chargement hiérarchique limité (Eloquent + with)
        $directions = Direction::with([
            'services' => function ($query) {
                $query->select('id', 'nom', 'direction_id');
            },
            'services.formations' => function ($query) {
                $query->select('id', 'titre', 'date_debut', 'date_fin', 'service_id')
                      ->latest('date_debut')
                      ->limit(3); // on limite les formations pour chaque service
            }
        ])
        ->select('id', 'nom')
        ->limit(5)
        ->get(); // Eager loading limité

        // Statistiques de formation
        $today = Carbon::today();

        $formationsPassees = Formation::where('date_fin', '<', $today)->count();

        $formationsEnCours = Formation::where(function ($query) use ($today) {
            $query->whereDate('date_debut', '<=', $today)
                  ->whereDate('date_fin', '>=', $today);
        })->count();

        $formationsAVenir = Formation::where('date_debut', '>', $today)->count();

        // Derniers commentaires
        $comments = Comment::with('user:id,nom,prenom')
                           ->latest()
                           ->limit(3)
                           ->get();

        return view('welcome', compact(
            'directions',
            'formationsPassees',
            'formationsEnCours',
            'formationsAVenir',
            'comments'
        ));
    }

    // 🏠 Page après connexion
    public function home()
    {
        $user = Auth::user();

        $users = User::with('role:id,nom')
                     ->select('id', 'nom', 'prenom', 'email', 'role_id')
                     ->paginate(10);

        $comments = Comment::with('user:id,nom,prenom')
                           ->latest()
                           ->take(5)
                           ->get();

        return view('home', compact('user', 'users', 'comments'));
    }

    // 📊 Tableau de bord
    public function dashboard()
    {
        $user = Auth::user();

        $users = User::with('role:id,nom')
                     ->select('id', 'nom', 'prenom', 'email', 'role_id')
                     ->paginate(10);

        $formationsStats = [
            'labels' => ['Jan', 'Fév', 'Mar', 'Avr', 'Mai'],
            'data' => [10, 15, 8, 20, 18]
        ];

        $participationStats = [
            'labels' => ['Formation A', 'Formation B', 'Formation C'],
            'data' => [50, 30, 40]
        ];

        $comments = Comment::with('user:id,nom,prenom')
                           ->latest()
                           ->take(5)
                           ->get();

        // ✅ Directions avec couleurs (à adapter dynamiquement si besoin)
        $directions = [
            ['Informatique', 'primary'],
            ['Ressources Humaines', 'success'],
            ['Finances', 'warning'],
            ['Logistique', 'danger'],
        ];

        return view('dashboard', compact(
            'user',
            'users',
            'formationsStats',
            'participationStats',
            'comments',
            'directions'
        ));
    }
}
