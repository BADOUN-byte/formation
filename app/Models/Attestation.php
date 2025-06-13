<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attestation extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'formation_id',
        'date_delivrance',
        'fichier_pdf',
    ];

    // Relation : un utilisateur possède plusieurs attestations
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relation : une formation possède plusieurs attestations
    public function formation()
    {
        return $this->belongsTo(Formation::class);
    }
}
