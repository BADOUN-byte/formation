<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index()
    {
        // Exemple : afficher les notifications de l'utilisateur connecté
        $notifications = auth()->user()->unreadNotifications;
        return view('notifications.index', compact('notifications'));
    }

    public function markAsRead()
    {
        auth()->user()->unreadNotifications->markAsRead();
        return redirect()->back()->with('success', 'Notifications marquées comme lues.');
    }
}

