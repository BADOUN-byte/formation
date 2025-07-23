<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    /**
     * Affiche tous les commentaires (page d'administration ou publique)
     */
    public function index()
    {
        $commentaires = Comment::with('user')->latest()->paginate(5);

        return view('commentaires.index', compact('commentaires'));
    }

    /**
     * Enregistre un nouveau commentaire lié à une formation
     */
    public function store(Request $request, ?int $formationId = null)
    {
        $request->validate([
            'contenu' => 'required|string',
        ]);

        Comment::create([
            'contenu'      => $request->contenu,
            'user_id'      => Auth::id(),
            'formation_id' => $formationId,
        ]);

        // Retour à la même page avec message succès
        return redirect()->back()->with('success', 'Commentaire ajouté avec succès.');
    }

    /**
     * Enregistre un nouveau commentaire global (pas lié à une formation)
     */
    public function storeGlobal(Request $request)
    {
        $request->validate([
            'contenu' => 'required|string',
        ]);

        Comment::create([
            'contenu'      => $request->contenu,
            'user_id'      => Auth::id(),
            'formation_id' => null,
        ]);

        // Retour à la même page avec message succès
        return redirect()->back()->with('success', 'Commentaire global ajouté avec succès.');
    }

    /**
     * Supprime un commentaire (admin ou auteur uniquement)
     */
    public function destroy(Comment $comment)
    {
        $user = Auth::user();

        if ($user && ($user->id === $comment->user_id || $user->role?->name === 'admin')) {
            $comment->delete();

            return redirect()->back()->with('success', 'Commentaire supprimé.');
        }

        return redirect()->back()->with('error', 'Action non autorisée.');
    }
}
