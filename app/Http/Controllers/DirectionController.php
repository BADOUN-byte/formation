<?php

namespace App\Http\Controllers;

use App\Models\Direction;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DirectionController extends Controller
{
    /**
     * Affiche la liste des directions avec leurs formations et services.
     */
    public function index()
    {
        $this->authorizeAdmin();

        $directions = Direction::with(['formations', 'services'])->get();

        return view('directions.index', compact('directions'));
    }

    /**
     * Affiche le formulaire de création d'une direction.
     */
    public function create()
    {
        $this->authorizeAdmin();

        return view('directions.create');
    }

    /**
     * Enregistre une nouvelle direction.
     */
    public function store(Request $request)
    {
        $this->authorizeAdmin();

        $validated = $request->validate([
            'nom' => 'required|string|max:255|unique:directions,nom',
            'description' => 'nullable|string',
        ], [
            'nom.required' => 'Le nom est obligatoire.',
            'nom.unique' => 'La direction existe déjà. Veuillez choisir un autre nom.',
        ]);

        Direction::create($validated);

        return redirect()->route('admin.directions.index')
                         ->with('success', 'Direction créée avec succès 🎉');
    }

    /**
     * Affiche la liste hiérarchique des directions avec services et formations.
     */
    public function liste()
    {
        $directions = Direction::with('services.formations')->get();
        return view('directions.liste', compact('directions'));
    }

    /**
     * Affiche le formulaire de modification d'une direction.
     */
    public function edit(Direction $direction)
    {
        $this->authorizeAdmin();

        return view('directions.edit', compact('direction'));
    }

    /**
     * Met à jour une direction existante.
     */
    public function update(Request $request, Direction $direction)
    {
        $this->authorizeAdmin();

        $validated = $request->validate([
            'nom' => 'required|string|max:255|unique:directions,nom,' . $direction->id,
            'description' => 'nullable|string',
        ], [
            'nom.required' => 'Le nom est obligatoire.',
            'nom.unique' => 'Ce nom de direction est déjà utilisé.',
        ]);

        $direction->update($validated);

        return redirect()->route('admin.directions.index')->with('success', 'Direction mise à jour avec succès.');
    }

    /**
     * Supprime une direction.
     */
    public function destroy(Direction $direction)
    {
        $this->authorizeAdmin();

        $direction->delete();

        return redirect()->route('admin.directions.index')->with('success', 'Direction supprimée.');
    }

    /**
     * Affiche la liste paginée des services liés à une direction spécifique.
     */
    public function services(Direction $direction)
    {
        $this->authorizeAdmin();

        $services = $direction->services()->paginate(15);

        return view('services.indexParDirection', compact('direction', 'services'));
    }

    /**
     * Affiche le formulaire de création d'un service rattaché à une direction.
     */
    public function createService(Direction $direction)
    {
        $this->authorizeAdmin();

        return view('services.create', compact('direction'));
    }

    /**
     * Enregistre un nouveau service rattaché à une direction.
     */
    public function storeService(Request $request, Direction $direction)
    {
        $this->authorizeAdmin();

        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $service = new Service($validated);
        $service->direction()->associate($direction);
        $service->save();

        return redirect()->route('admin.directions.index')
                         ->with('success', 'Service ajouté avec succès à la direction.');
    }

    /**
     * Renvoie les détails d'une direction (pour modal ou vue spécifique).
     */
    public function detail(Direction $direction)
    {
        $direction->load(['services', 'formations']);

        return view('directions.detail', compact('direction'));
    }

    /**
     * Vérifie si l'utilisateur est un administrateur.
     */
    private function authorizeAdmin()
    {
        if (!Auth::check() || !Auth::user()->isAdmin()) {
            abort(403, 'Accès réservé aux administrateurs.');
        }
    }
}
