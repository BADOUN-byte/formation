<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

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

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function formations()
    {
        return $this->belongsToMany(Formation::class)
                    ->withPivot('role_in_formation')
                    ->withTimestamps();
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function attestations()
    {
        return $this->hasMany(Attestation::class);
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

    // === Nom complet virtuel ===

    public function getFullNameAttribute(): string
    {
        return $this->prenom . ' ' . $this->nom;
    }
}
