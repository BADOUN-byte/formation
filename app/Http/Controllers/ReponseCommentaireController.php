<?php

namespace App\Http\Controllers;

use App\Models\ReponseCommentaire;
use Illuminate\Http\Request;

class ReponseCommentaireController extends Controller
{
    public function store(Request $request, $commentaireId)
    {
        $request->validate([
            'contenu' => 'required|string|max:1000',
        ]);

        ReponseCommentaire::create([
            'commentaire_id' => $commentaireId,
            'user_id' => auth()->id(),
            'contenu' => $request->contenu,
        ]);

        return back()->with('success', 'Réponse ajoutée avec succès.');
    }

    public function destroy(ReponseCommentaire $reponse)
    {
        if ($reponse->user_id !== auth()->id() && !auth()->user()->isAdmin()) {
            abort(403);
        }

        $reponse->delete();
        return back()->with('success', 'Réponse supprimée.');
    }
}

