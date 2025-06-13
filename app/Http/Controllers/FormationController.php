<?php

namespace App\Http\Controllers;

use App\Models\Formation;
use App\Models\User;
use App\Models\Role;
use App\Models\Service;
use App\Models\Direction;
use Illuminate\Http\Request;

class FormationController extends Controller
{
    public function index()
    {
        $formations = Formation::with(['formateur', 'participants', 'service.direction'])->paginate(10);
        return view('formations.index', compact('formations'));
    }

    public function create()
    {
        $formateurs = User::where('role_id', Role::FORMATEUR)->get();
        $services = Service::with('direction')->get();

        return view('formations.create', compact('formateurs', 'services'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'nullable|string',
            'type' => 'required|string|max:255',
            'date_debut' => 'required|date',
            'date_fin' => 'required|date|after_or_equal:date_debut',
            'lieu' => 'required|string|max:255',
            'volume_horaire' => 'required|integer|min:0',
            'statut' => 'nullable|string|in:en cours,terminée,annulée',
            'formateur_id' => 'required|exists:users,id',
            'service_id' => 'required|exists:services,id',
            'participants' => 'nullable|array',
            'participants.*' => 'exists:users,id',
        ]);

        $formation = Formation::create($request->only([
            'titre',
            'description',
            'type',
            'date_debut',
            'date_fin',
            'lieu',
            'volume_horaire',
            'statut',
            'formateur_id',
            'service_id'
        ]));

        if ($request->has('participants')) {
            $formation->participants()->sync($request->participants);
        }

        return redirect()->route('formations.index')->with('success', 'Formation ajoutée avec succès.');
    }

    public function show(Formation $formation)
    {
        $formation->load(['formateur', 'participants', 'service.direction']);
        return view('formations.show', compact('formation'));
    }

    public function edit(Formation $formation)
    {
        $formateurs = User::where('role_id', Role::FORMATEUR)->get();
        $services = Service::with('direction')->get();
        $formation->load('participants');

        return view('formations.edit', compact('formation', 'formateurs', 'services'));
    }

    public function update(Request $request, Formation $formation)
    {
        $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'nullable|string',
            'type' => 'required|string|max:255',
            'date_debut' => 'required|date',
            'date_fin' => 'required|date|after_or_equal:date_debut',
            'lieu' => 'required|string|max:255',
            'volume_horaire' => 'required|integer|min:0',
            'statut' => 'nullable|string|in:en cours,terminée,annulée',
            'formateur_id' => 'required|exists:users,id',
            'service_id' => 'required|exists:services,id',
            'participants' => 'nullable|array',
            'participants.*' => 'exists:users,id',
        ]);

        $formation->update($request->only([
            'titre',
            'description',
            'type',
            'date_debut',
            'date_fin',
            'lieu',
            'volume_horaire',
            'statut',
            'formateur_id',
            'service_id'
        ]));

        if ($request->has('participants')) {
            $formation->participants()->sync($request->participants);
        }

        return redirect()->route('formations.index')->with('success', 'Formation mise à jour avec succès.');
    }

    public function destroy(Formation $formation)
    {
        $formation->participants()->detach();
        $formation->delete();

        return redirect()->route('formations.index')->with('success', 'Formation supprimée.');
    }

    public function indexParDirection($directionId)
    {
        $direction = Direction::findOrFail($directionId);

        $formations = Formation::whereHas('service', function ($query) use ($directionId) {
            $query->where('direction_id', $directionId);
        })->with(['formateur', 'participants', 'service.direction'])->paginate(10);

        return view('formations.index_par_direction', compact('formations', 'direction'));
    }
}
