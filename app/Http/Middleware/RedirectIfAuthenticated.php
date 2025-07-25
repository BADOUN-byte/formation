<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider; // ← ✅ IMPORT OBLIGATOIRE
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next, ...$guards): Response
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                return redirect(RouteServiceProvider::HOME); // ← ✅ C’est ici qu’on utilise la constante
            }
        }

        return $next($request);
    }
}
