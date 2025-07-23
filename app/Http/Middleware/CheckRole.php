<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    public function handle($request, Closure $next, $role)
    {
        $user = Auth::user();

        if (!$user) {
            return redirect('/')->with('error', 'Vous devez être connecté pour accéder à cette page.');
        }

        // Convertit "admin" en "isAdmin", etc.
        $method = 'is' . ucfirst(strtolower($role));

        if (!method_exists($user, $method) || !$user->$method()) {
            return redirect('/')->with('error', "Accès interdit. Vous devez être un {$role}.");
        }

        return $next($request);
    }
}
