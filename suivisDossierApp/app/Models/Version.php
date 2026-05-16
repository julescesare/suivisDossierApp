<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Version extends Model
{
    protected $fillable = [
        'dossier_id',
        'type_version_id',
        'numero_depot',
        'date_depot',
        'created_by'
    ];

    protected $casts = [
        'date_depot' => 'date',
    ];

    public function dossier()
    {
        return $this->belongsTo(Dossier::class);
    }

    public function typeVersion()
    {
        return $this->belongsTo(TypeVersion::class);
    }
}
