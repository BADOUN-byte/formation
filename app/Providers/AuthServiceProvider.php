<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\Formation;
use App\Models\User;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Les politiques d'autorisation pour l'application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // Exemple :
        // Formation::class => FormationPolicy::class,
    ];

    /**
     * Enregistrement de toutes les autorisations.
     */
    public function boot()
    {
        $this->registerPolicies();

        // 🔐 Exemple de Gates simples par rôle
        Gate::define('admin', fn(User $user) => $user->isAdmin());
        Gate::define('formateur', fn(User $user) => $user->isFormateur());
        Gate::define('participant', fn(User $user) => $user->isParticipant());
    }
}
