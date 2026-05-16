<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Personnel extends Model
{
    protected $fillable = [
        'nom',
        'prenom',
        'telephone',
        'fonction_id',
        'user_id',
        'created_by'
    ];

    public function fonction()
    {
        return $this->belongsTo(Fonction::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function dossiers()
    {
        return $this->belongsToMany(
            Dossier::class,
            'dossier_personnel'
        )->withPivot('role_dans_dossier')
            ->withTimestamps();
    }
}
