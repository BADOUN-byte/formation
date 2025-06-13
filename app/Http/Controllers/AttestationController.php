<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attestation;
use App\Models\User;
use App\Models\Formation;
use Illuminate\Support\Facades\Storage;

class AttestationController extends Controller
{
    // Affiche toutes les attestations
    public function index()
    {
        $attestations = Attestation::with(['user', 'formation'])->get();
        return view('attestations.index', compact('attestations'));
    }

    // Affiche le formulaire de création
    public function create()
    {
        $users = User::all();
        $formations = Formation::all();
        return view('attestations.create', compact('users', 'formations'));
    }

    // Enregistre l'attestation et téléverse le PDF
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'formation_id' => 'required|exists:formations,id',
            'date_emission' => 'required|date',
            'fichier_pdf' => 'required|file|mimes:pdf|max:2048',
        ]);

        // Enregistrement du fichier PDF avec nom unique
        $pdfName = 'attestation_' . time() . '.' . $request->fichier_pdf->extension();
        $request->fichier_pdf->storeAs('public/attestations', $pdfName);

        // Création en base
        Attestation::create([
            'user_id' => $request->user_id,
            'formation_id' => $request->formation_id,
            'date_emission' => $request->date_emission,
            'fichier_pdf' => $pdfName,
        ]);

        return redirect()->route('attestations.index')->with('success', 'Attestation ajoutée avec succès.');
    }

    // Télécharge un fichier PDF
    public function download($id)
    {
        $attestation = Attestation::findOrFail($id);
        $path = storage_path('app/public/attestations/' . $attestation->fichier_pdf);

        if (!file_exists($path)) {
            return redirect()->back()->with('error', 'Fichier introuvable.');
        }

        return response()->download($path);
    }

    // Supprime une attestation et le fichier lié
    public function destroy($id)
    {
        $attestation = Attestation::findOrFail($id);

        // Supprimer le fichier physique
        Storage::delete('public/attestations/' . $attestation->fichier_pdf);

        // Supprimer la ligne en base
        $attestation->delete();

        return redirect()->route('attestations.index')->with('success', 'Attestation supprimée.');
    }
}
