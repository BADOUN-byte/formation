<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use App\Models\Role;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  mixed  ...$roles
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        $user = Auth::user();

        if (!$user) {
            abort(403, 'Utilisateur non authentifié.');
        }

        // Convertir les noms de rôles (admin, formateur, etc.) en ID si besoin
        $roleMap = [
            'admin'     => Role::ADMIN,
            'formateur' => Role::FORMATEUR,
            'participant' => Role::PARTICIPANT,
        ];

        $roleIds = array_map(fn($r) => $roleMap[$r] ?? null, $roles);

        if (!in_array($user->role_id, $roleIds)) {
            abort(403, 'Accès non autorisé.');
        }

        return $next($request);
    }
}
