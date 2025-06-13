<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    // Laravel attend une table "comments", donc on précise "commentaires"
    protected $table = 'commentaires';

    protected $fillable = [

        'contenu',
        'user_id',
    ];

    /**
     * Relation : un commentaire appartient à un utilisateur
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * (Optionnel) Ajoute cette relation si tu veux lier un commentaire à une formation
     */
    public function formation()
    {
        return $this->belongsTo(Formation::class);
    }
}

