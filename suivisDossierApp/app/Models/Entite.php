<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Entite extends Model
{
    protected $fillable = [
        'nom',
        'nom_court',
        'description',
        'created_by'
    ];

    public function dossiers()
    {
        return $this->belongsToMany(
            Dossier::class,
            'dossier_entite'
        )->withTimestamps();
    }
}
