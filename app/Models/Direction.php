<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Direction extends Model
{
    protected $fillable = ['nom'];

    /**
     * Une direction a plusieurs services.
     *
     * @return HasMany
     */
    public function services(): HasMany
    {
        return $this->hasMany(Service::class);
    }

    /**
     * Une direction a plusieurs formations.
     *
     * @return HasMany
     */
    public function formations(): HasMany
    {
        return $this->hasMany(Formation::class);
    }
}
