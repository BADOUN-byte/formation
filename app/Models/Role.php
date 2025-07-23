<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Role extends Model
{
    use HasFactory;

    /**
     * Attributs assignables.
     */
    protected $fillable = ['nom'];

    /**
     * Constantes des rôles.
     */
    public const ADMIN = 1;
    public const FORMATEUR = 2;
    public const PARTICIPANT = 3;

    /**
     * Relation : un rôle possède plusieurs utilisateurs.
     */
    public function users(): HasMany
    {
        return $this->hasMany(User::class, 'role_id');
    }

    /**
     * Récupère le nom lisible du rôle à partir de son ID.
     */
    public static function getLabel(int $roleId): string
    {
        return match ($roleId) {
            self::ADMIN => 'Administrateur',
            self::FORMATEUR => 'Formateur',
            self::PARTICIPANT => 'Participant',
            default => 'Inconnu',
        };
    }

    /**
     * Retourne un tableau des rôles avec leurs libellés (id => nom).
     * Utile pour générer des listes déroulantes dans les formulaires.
     */
    public static function allLabels(): array
    {
        return [
            self::ADMIN => 'Administrateur',
            self::FORMATEUR => 'Formateur',
            self::PARTICIPANT => 'Participant',
        ];
    }

    /**
     * Accesseur personnalisé pour obtenir le libellé du rôle.
     * Usage : $role->label
     */
    public function getLabelAttribute(): string
    {
        return self::getLabel($this->id);
    }
}
