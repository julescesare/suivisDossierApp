<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ano extends Model
{
    protected $table = 'anos';
    protected $fillable = [
        'avis',
        'description',
        'created_by'
    ];

    public function dossiers()
    {
        return $this->hasMany(Dossier::class);
    }
}
