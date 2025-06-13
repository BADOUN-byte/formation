<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Service;

class Formation extends Model
{
    protected $fillable = [
        'titre',
        'description',
        'type',
        'date_debut',
        'date_fin',
        'lieu',
        'volume_horaire',
        'statut',
        'formateur_id',  // id de l'utilisateur formateur
        'service_id',
    ];

    // CAST des dates en objets Carbon
    protected $casts = [
        'date_debut' => 'datetime',
        'date_fin' => 'datetime',
    ];

    // Relation vers le formateur (User)
    public function formateur()
    {
        return $this->belongsTo(User::class, 'formateur_id');
    }

    // Relation vers les participants (plusieurs utilisateurs)
    public function participants()
    {
        return $this->belongsToMany(User::class, 'formation_user', 'formation_id', 'user_id')
                    ->withTimestamps();
    }

    // Relation vers le service
    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
