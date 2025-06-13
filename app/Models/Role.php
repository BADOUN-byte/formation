<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Role extends Model
{
    use HasFactory;

    protected $fillable = ['nom'];

    // Constantes pour faciliter l'utilisation des rôles dans le code
    public const ADMIN = 1;
    public const FORMATEUR = 2;
    public const PARTICIPANT = 3;

    /**
     * Un rôle peut être assigné à plusieurs utilisateurs
     */
    public function users()
    {
        return $this->hasMany(User::class);
    }
}
