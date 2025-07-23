<?php

namespace App\Http\Controllers;

use App\Models\Formation;
use App\Models\User;
use App\Models\Role;
use App\Models\Service;
use App\Models\Direction;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FormationController extends Controller
{
    protected const PAGINATION_LIMIT = 10;

    public function index()
    {
        if (!auth()->user()->isAdmin()) {
            abort(403, 'Seuls les administrateurs peuvent accéder à cette page.');
        }

        $formations = Formation::with(['formateurs', 'participants', 'services.direction'])
            ->paginate(self::PAGINATION_LIMIT);

        return view('formations.index', compact('formations'));
    }

    public function indexParDirection($directionId)
    {
        $direction = Direction::findOrFail($directionId);

        $formations = Formation::where('direction_id', $directionId)
            ->with(['formateurs', 'participants', 'services.direction'])
            ->paginate(self::PAGINATION_LIMIT);

        return view('formations.index_par_direction', compact('direction', 'formations'));
    }

    public function create()
    {
        if (!auth()->user()->isAdmin()) {
            abort(403);
        }

        $formateurs = User::where('role_id', Role::FORMATEUR)->get();
        $participants = User::where('role_id', Role::PARTICIPANT)->get();
        $services = Service::with('direction')->get();
        $directions = Direction::all();

        return view('formations.create', compact('formateurs', 'participants', 'services', 'directions'));
    }

    public function store(Request $request)
    {
        if (!auth()->user()->isAdmin()) {
            abort(403);
        }

        $validated = $this->validateFormation($request);
        $serviceIds = $this->resolveServiceIds($validated);

        $formation = Formation::create([
            'titre' => $validated['titre'],
            'description' => $validated['description'] ?? null,
            'type' => $validated['type'],
            'date_debut' => $validated['date_debut'],
            'date_fin' => $validated['date_fin'],
            'lieu' => $validated['lieu'],
            'volume_horaire' => $validated['volume_horaire'],
            'statut' => $validated['statut'],
            'direction_id' => $validated['direction_id'],
            'formateur_id' => $validated['formateur_id'],
        ]);

        $formation->services()->sync($serviceIds);

        if (!empty($validated['participants'])) {
            $formation->participants()->sync($validated['participants']);
        }

        return redirect()->route('admin.formations.index')->with('success', 'Formation créée avec succès.');
    }

    public function show(Formation $formation)
    {
        $formation->load(['formateurs', 'participants', 'services.direction']);
        $isAdmin = Auth::user()?->isAdmin();

        $commentaires = Comment::where('formation_id', $formation->id)
            ->with('user')
            ->latest()
            ->get();

        return view('formations.show', compact('formation', 'isAdmin', 'commentaires'));
    }

    public function edit(Formation $formation)
    {
        $user = auth()->user();

        if (!($user->isAdmin() || ($user->isFormateur() && $formation->formateur_id === $user->id))) {
            abort(403);
        }

        $formateurs = User::where('role_id', Role::FORMATEUR)->get();
        $participants = User::where('role_id', Role::PARTICIPANT)->get();
        $services = Service::with('direction')->get();
        $directions = Direction::all();

        $formation->load(['formateurs', 'participants', 'services']);

        return view('formations.edit', compact('formation', 'formateurs', 'participants', 'services', 'directions'));
    }

    public function update(Request $request, Formation $formation)
    {
        $user = auth()->user();

        if (!($user->isAdmin() || ($user->isFormateur() && $formation->formateur_id === $user->id))) {
            abort(403);
        }

        $validated = $this->validateFormation($request);
        $serviceIds = $this->resolveServiceIds($validated);

        $formation->update([
            'titre' => $validated['titre'],
            'description' => $validated['description'] ?? null,
            'type' => $validated['type'],
            'date_debut' => $validated['date_debut'],
            'date_fin' => $validated['date_fin'],
            'lieu' => $validated['lieu'],
            'volume_horaire' => $validated['volume_horaire'],
            'statut' => $validated['statut'],
            'direction_id' => $validated['direction_id'],
            'formateur_id' => $validated['formateur_id'],
        ]);

        $formation->services()->sync($serviceIds);

        if (!empty($validated['participants'])) {
            $formation->participants()->sync($validated['participants']);
        } else {
            $formation->participants()->detach();
        }

        return redirect()->route('admin.formations.index')->with('success', 'Formation mise à jour avec succès.');
    }

    public function destroy(Formation $formation)
    {
        $user = auth()->user();

        if (!($user->isAdmin() || ($user->isFormateur() && $formation->formateur_id === $user->id))) {
            abort(403);
        }

        $formation->services()->detach();
        $formation->participants()->detach();
        $formation->delete();

        return redirect()->route('admin.formations.index')->with('success', 'Formation supprimée.');
    }

    public function listePourParticipants()
    {
        if (!auth()->user()->isParticipant()) {
            abort(403);
        }

        $formations = Formation::with('services.direction')->get();

        return view('formations.participant', compact('formations'));
    }

    public function inscrire(Formation $formation)
    {
        $user = auth()->user();

        if ($formation->participants()->where('user_id', $user->id)->exists()) {
            return redirect()->back()->with('info', 'Vous êtes déjà inscrit à cette formation.');
        }

        $formation->participants()->attach($user->id);

        return redirect()->back()->with('success', 'Inscription réussie à la formation.');
    }

    public function mesFormations()
    {
        $user = auth()->user();

        if (!$user->isFormateur()) {
            abort(403);
        }

        $formations = Formation::where('formateur_id', $user->id)->get();

        return view('formations.mes_formations', compact('formations'));
    }

    protected function validateFormation(Request $request): array
    {
        return $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'nullable|string',
            'type' => 'required|string|in:présentiel,distanciel,hybride',
            'date_debut' => 'required|date',
            'date_fin' => 'required|date|after_or_equal:date_debut',
            'lieu' => 'required|string|max:255',
            'volume_horaire' => 'required|integer|min:1',
            'statut' => 'required|in:en_attente,en_cours,terminée,annulée',
            'direction_id' => 'required|exists:directions,id',
            'formateur_id' => 'required|exists:users,id',
            'service_id' => 'nullable',
            'service_custom' => 'nullable|string|max:255',
            'participants' => 'nullable|array',
            'participants.*' => 'exists:users,id',
        ]);
    }

    protected function resolveServiceIds(array $validated): array
    {
        $serviceIds = [];

        if (($validated['service_id'] ?? null) === 'autre' && !empty($validated['service_custom'])) {
            $customNom = trim($validated['service_custom']);

            $existing = Service::where('nom', $customNom)
                ->where('direction_id', $validated['direction_id'])
                ->first();

            if ($existing) {
                $serviceIds[] = $existing->id;
            } else {
                $newService = Service::create([
                    'nom' => $customNom,
                    'direction_id' => $validated['direction_id'],
                ]);
                $serviceIds[] = $newService->id;
            }
        } elseif (is_numeric($validated['service_id'] ?? null)) {
            $serviceIds[] = $validated['service_id'];
        }

        return $serviceIds;
    }

    public function ajouterParticipantForm($formationId)
    {
        $formation = Formation::findOrFail($formationId);
        $participants = User::where('role_id', Role::PARTICIPANT)->get();

        return view('formations.ajouter_participant', compact('formation', 'participants'));
    }

    public function ajouterParticipant(Request $request, $formationId)
    {
        $request->validate([
            'participant_id' => 'required|exists:users,id',
        ]);

        $formation = Formation::findOrFail($formationId);
        $participant = User::findOrFail($request->participant_id);

        if (!$formation->participants()->where('user_id', $participant->id)->exists()) {
            $formation->participants()->attach($participant->id);
        }

        return redirect()->back()->with('success', 'Participant ajouté à la formation.');
    }
}
