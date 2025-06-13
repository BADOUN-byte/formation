<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Service extends Model 
{
    protected $fillable = ['nom', 'description', 'direction_id'];

    /**
     * Le service appartient à une direction.
     */
    public function direction(): BelongsTo
    {
        return $this->belongsTo(Direction::class);
    }

    /**
     * Formateurs du service (utilisateurs avec rôle 'formateur').
     */
    public function formateurs(): HasMany
    {
        return $this->hasMany(User::class)->whereHas('role', function ($query) {
            $query->where('id', Role::FORMATEUR); // Utilisation des constantes
        });
    }

    /**
     * Participants du service (utilisateurs avec rôle 'participant').
     */
    public function participants(): HasMany
    {
        return $this->hasMany(User::class)->whereHas('role', function ($query) {
            $query->where('id', Role::PARTICIPANT); // Utilisation des constantes
        });
    }

    /**
     * Formations proposées par ce service.
     */
    public function formations(): HasMany
    {
        return $this->hasMany(Formation::class);
    }
}
