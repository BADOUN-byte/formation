<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Direction;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    /**
     * Liste complète des services avec pagination.
     */
    public function index()
    {
        // Charge tous les services avec leur direction associée
        $services = Service::with('direction')->paginate(15);

        // Pas de $direction fourni ici
        return view('services.index', compact('services'));
    }

    /**
     * Liste des services filtrés par direction.
     */
    public function indexParDirection(Direction $direction)
    {
        // Récupère uniquement les services liés à la direction donnée
        $services = $direction->services()->with('direction')->paginate(15);

        // Envoie $direction à la vue pour affichage du filtre
        return view('services.index', compact('services', 'direction'));
    }

    /**
     * Formulaire de création.
     */
    public function create()
    {
        $directions = Direction::all();
        return view('services.create', compact('directions'));
    }

    /**
     * Enregistrement en base.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'description' => 'nullable|string',
            'direction_id' => 'required|exists:directions,id',
        ]);

        Service::create($validated);

        return redirect()->route('admin.services.index')
                         ->with('success', 'Service ajouté avec succès.');
    }

    /**
     * Affiche un service.
     */
    public function show(Service $service)
    {
        $service->load('direction');
        return view('services.show', compact('service'));
    }

    /**
     * Formulaire d'édition.
     */
    public function edit(Service $service)
    {
        $directions = Direction::all();
        return view('services.edit', compact('service', 'directions'));
    }

    /**
     * Mise à jour.
     */
    public function update(Request $request, Service $service)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'description' => 'nullable|string',
            'direction_id' => 'required|exists:directions,id',
        ]);

        $service->update($validated);

        return redirect()->route('admin.services.index')
                         ->with('success', 'Service mis à jour avec succès.');
    }

    /**
     * Suppression.
     */
    public function destroy(Service $service)
    {
        $service->delete();
        return redirect()->route('admin.services.index')
                         ->with('success', 'Service supprimé avec succès.');
    }

    /**
     * API JSON pour récupérer les services d'une direction.
     */
    public function getServices(Direction $direction)
    {
        $services = $direction->services()
                              ->select('id', 'nom')
                              ->orderBy('nom')
                              ->get();

        return response()->json($services);
    }
}
