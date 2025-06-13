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

    // Relations optionnelles (utiles pour accéder aux données associées depuis ce modèle)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function formation()
    {
        return $this->belongsTo(Formation::class);
    }
}


