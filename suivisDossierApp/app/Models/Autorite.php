<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Autorite extends Model
{
    protected $table = 'autorites';
    protected $fillable = [
        'nom',
        'telephone',
        'email',
        'description',
        'created_by'
    ];

    public function dossiers()
    {
        return $this->hasMany(Dossier::class);
    }
}
