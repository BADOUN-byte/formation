<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Comment;
use App\Models\Direction;
use App\Models\Formation;
use App\Models\Role;
use App\Models\Service;

class HomeController extends Controller
{
    /**
     * Page d’accueil publique (non connecté)
     */
    public function index()
    {
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }

        $directions = Direction::with('services.formations')->get();
        $now = now();

        return view('welcome', [
            'directions' => $directions,
            'formationsPassees' => Formation::where('date_fin', '<', $now)->count(),
            'formationsEnCours' => Formation::where('date_debut', '<=', $now)->where('date_fin', '>=', $now)->count(),
            'formationsAVenir' => Formation::where('date_debut', '>', $now)->count(),
            'comments' => Comment::with('user:id,nom,prenom')->latest()->take(5)->get(),
        ]);
    }

    /**
     * Redirection après login
     */
    public function home()
    {
        return $this->dashboard();
    }

    /**
     * Tableau de bord unifié
     */
    public function dashboard()
    {
        $user = Auth::user();
        $now = now();

        $stats = [
            'formationsPassees' => Formation::where('date_fin', '<', $now)->count(),
            'formationsEnCours' => Formation::where('date_debut', '<=', $now)->where('date_fin', '>=', $now)->count(),
            'formationsAVenir' => Formation::where('date_debut', '>', $now)->count(),
        ];

        $commentaires = Comment::latest()->take(5)->get();

        switch ($user->role_id) {
            case Role::ADMIN:
                $directions = Direction::withCount('services')->get();
                $services = Service::all();
                $totalFormations = Formation::count();
                $totalFormateurs = User::where('role_id', Role::FORMATEUR)->count();
                $totalParticipants = User::where('role_id', Role::PARTICIPANT)->count();
                $totalServices = Service::count();
                $users = User::orderBy('nom')->paginate(10);
                $roles = Role::whereIn('id', [Role::ADMIN, Role::FORMATEUR, Role::PARTICIPANT])->get();
                $formations = Formation::all();

                return view('dashboard', compact(
                    'user', 'stats', 'commentaires',
                    'directions', 'services',
                    'totalFormations', 'totalFormateurs',
                    'totalParticipants', 'totalServices',
                    'users', 'roles',
                    'formations'
                ));

            case Role::FORMATEUR:
                $formations = $user->formationsFormateur ?? collect();
                return view('dashboard', compact('user', 'stats', 'commentaires', 'formations'));

            case Role::PARTICIPANT:
                $formations = $user->formationsParticipant ?? collect();
                return view('dashboard', compact('user', 'stats', 'commentaires', 'formations'));

            default:
                abort(403, 'Rôle non autorisé.');
        }
    }

    /**
     * Statistiques par direction
     */
    public function directionStats(Direction $direction)
    {
        $formations = Formation::where('direction_id', $direction->id)->get();
        $services = $direction->services()->withCount('formations')->get();

        return view('admin.directions.stats', compact('direction', 'formations', 'services'));
    }

    /**
     * Statistiques globales
     */
    public function globalStats()
    {
        $stats = [
            'totalUtilisateurs' => User::count(),
            'totalFormateurs' => User::where('role_id', Role::FORMATEUR)->count(),
            'totalParticipants' => User::where('role_id', Role::PARTICIPANT)->count(),
            'totalFormations' => Formation::count(),
            'totalServices' => Service::count(),
            'totalCommentaires' => Comment::count(),
        ];

        return view('admin.statistiques.globales', compact('stats'));
    }
}
