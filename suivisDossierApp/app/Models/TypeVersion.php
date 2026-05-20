<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TypeVersion extends Model
{
    protected $fillable = [
        'libelle',
        'description',
        'created_by'
    ];

    public function dossiers()
    {
        return $this->hasMany(Dossier::class);
    }
}
