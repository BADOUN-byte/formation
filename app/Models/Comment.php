<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $table = 'commentaires';

    protected $fillable = [
        'contenu',
        'user_id',
        'formation_id',
        'parent_id', // si tu veux faire des réponses imbriquées
    ];

    /**
     * Relation : un commentaire appartient à un utilisateur
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Un commentaire appartient à une formation
     */
    public function formation()
    {
        return $this->belongsTo(Formation::class);
    }

    /**
     * Un commentaire peut avoir des réponses (auto-relation)
     */
    public function reponses()
    {
        return $this->hasMany(Comment::class, 'parent_id');
    }

    /**
     * Un commentaire peut avoir un parent
     */
    public function parent()
    {
        return $this->belongsTo(Comment::class, 'parent_id');
    }
}
