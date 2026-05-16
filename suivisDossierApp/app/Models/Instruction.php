<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Instruction extends Model
{
    protected $fillable = [
        'contenu',
        'created_by'
    ];

    public function dossiers()
    {
        return $this->belongsToMany(
            Dossier::class,
            'dossier_instruction'
        )->withTimestamps();
    }
}
