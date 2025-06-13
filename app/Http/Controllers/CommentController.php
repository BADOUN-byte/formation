<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    /**
     * Affiche tous les commentaires (optionnel, pour les pages publiques ou admin)
     */
    public function index()
    {
        $commentaires = Comment::with('user')->latest()->get();
        return view('commentaires.index', compact('commentaires'));
    }

    /**
     * Enregistre un nouveau commentaire
     */
    public function store(Request $request)
    {
        $request->validate([
            'titre' => 'required|string|max:255',
            'contenu' => 'required|string',
        ]);

        Comment::create([
            'titre' => $request->titre,
            'contenu' => $request->contenu,
            'user_id' => Auth::id(),
        ]);

        return redirect()->back()->with('success', 'Commentaire ajouté avec succès.');
    }

    /**
     * Supprime un commentaire (optionnel, par un admin ou l’auteur)
     */
    public function destroy(Comment $comment)
    {
        if (Auth::id() === $comment->user_id || Auth::user()->role->name === 'admin') {
            $comment->delete();
            return redirect()->back()->with('success', 'Commentaire supprimé.');
        }

        return redirect()->back()->with('error', 'Action non autorisée.');
    }
}
