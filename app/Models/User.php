<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Relations\{BelongsTo, BelongsToMany, HasMany};
use Illuminate\Database\Eloquent\Builder;

use App\Models\Role;
use App\Models\Service;
use App\Models\Formation;
use App\Models\Comment;
use App\Models\Attestation;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'nom',
        'prenom',
        'email',
        'password',
        'matricule',
        'grade',
        'fonction',
        'role_id',
        'service_id',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // === Relations ===

    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class);
    }

    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }

    public function formations(): BelongsToMany
    {
        return $this->belongsToMany(Formation::class, 'formation_user', 'user_id', 'formation_id')
                    ->withPivot('role_in_formation')
                    ->withTimestamps();
    }

    public function formationsFormateur(): BelongsToMany
    {
        return $this->formations()->wherePivot('role_in_formation', 'formateur');
    }

    public function formationsParticipant(): BelongsToMany
    {
        return $this->formations()->wherePivot('role_in_formation', 'participant');
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    public function attestations(): HasMany
    {
        return $this->hasMany(Attestation::class);
    }

    // === Mutateurs ===

    public function setPasswordAttribute($value): void
    {
        if (!empty($value)) {
            $this->attributes['password'] = (strlen($value) === 60 && preg_match('/^\$2y\$/', $value))
                ? $value
                : Hash::make($value);
        }
    }

    // === Méthodes d’aide avec les constantes ===

    public function isAdmin(): bool
    {
        return $this->role_id === Role::ADMIN;
    }

    public function isFormateur(): bool
    {
        return $this->role_id === Role::FORMATEUR;
    }

    public function isParticipant(): bool
    {
        return $this->role_id === Role::PARTICIPANT;
    }

    public function hasRole(string $role): bool
    {
        return optional($this->role)->nom === $role;
    }

    // === Accessor pour le nom complet ===

    public function getFullNameAttribute(): string
    {
        return trim("{$this->prenom} {$this->nom}");
    }

    // === Scopes ===

    public function scopeAdmins(Builder $query): Builder
    {
        return $query->where('role_id', Role::ADMIN);
    }

    public function scopeFormateurs(Builder $query): Builder
    {
        return $query->where('role_id', Role::FORMATEUR);
    }

    public function scopeParticipants(Builder $query): Builder
    {
        return $query->where('role_id', Role::PARTICIPANT);
    }
}
