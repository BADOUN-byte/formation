<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;
use App\Models\User;
use App\Models\Formation;

class FormationUser extends Pivot
{
    protected $table = 'formation_user';

    protected $fillable = [
        'formation_id',
        'user_id',
        'role_in_formation',
    ];

    public $timestamps = true;

    /**
     * Relation vers l'utilisateur associé
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relation vers la formation associée
     */
   public function formations()
{
    return $this->belongsToMany(Formation::class, 'formation_user');
}

}
