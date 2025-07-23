<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\User;
use App\Models\Service;
use App\Models\Direction;
use App\Models\Comment;

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
        'direction_id',
        'formateur_id',
        'nom_formateur',     // texte libre (ex: noms concaténés)
        'participants_pdf',
    ];

    protected $casts = [
        'date_debut' => 'datetime',
        'date_fin'   => 'datetime',
    ];

    /**
     * Formateurs liés à la formation (many-to-many avec pivot)
     *
     * @return BelongsToMany<User>
     */
    public function formateurs(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'formation_user', 'formation_id', 'user_id')
                    ->wherePivot('role_in_formation', 'formateur')
                    ->withPivot('role_in_formation')
                    ->withTimestamps();
    }

    /**
     * Participants liés à la formation (many-to-many avec pivot)
     *
     * @return BelongsToMany<User>
     */
    public function participants(): BelongsToMany
    {
        // Suppression du filtre wherePivot pour inclure les utilisateurs liés par inscription sans rôle
        return $this->belongsToMany(User::class, 'formation_user', 'formation_id', 'user_id')
                    ->withPivot('role_in_formation')
                    ->withTimestamps();
    }

    /**
     * Tous les utilisateurs liés à la formation (participants + formateurs)
     *
     * @return BelongsToMany<User>
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'formation_user', 'formation_id', 'user_id')
                    ->withPivot('role_in_formation')
                    ->withTimestamps();
    }

    /**
     * Services rattachés à la formation (many-to-many)
     *
     * @return BelongsToMany<Service>
     */
    public function services(): BelongsToMany
    {
        return $this->belongsToMany(Service::class, 'formation_service', 'formation_id', 'service_id')
                    ->withTimestamps();
    }

    /**
     * Direction associée à la formation (one-to-many inverse)
     *
     * @return BelongsTo<Direction>
     */
    public function direction(): BelongsTo
    {
        return $this->belongsTo(Direction::class);
    }

    /**
     * Commentaires associés à la formation
     *
     * @return HasMany<Comment>
     */
    public function commentaires(): HasMany
    {
        return $this->hasMany(Comment::class);
    }
}
