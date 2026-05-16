<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Nature extends Model
{
    protected $fillable = [
        'nom',
        'description',
        'created_by'
    ];

    public function dossiers()
    {
        return $this->hasMany(Dossier::class);
    }
}
