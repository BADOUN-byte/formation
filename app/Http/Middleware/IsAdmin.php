<?php

namespace App\Http\Middleware;
use App\Models\Role;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Vérifie que l'utilisateur est connecté et a le rôle admin
        if (Auth::check() && Auth::user()->isAdmin()) 
        {
            return $next($request);
        }

        // Sinon, accès refusé
        abort(403, 'Accès refusé. Administrateur uniquement.');
    }
}
