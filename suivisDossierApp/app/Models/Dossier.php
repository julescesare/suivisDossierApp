<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dossier extends Model
{
    protected $fillable = [
        'numero_reception',
        'objet',
        'autorite_id',
        'nature_id',
        'date_reception',
        'date_prevision_ppm',
        'respect_ppm',
        'date_limite_dn',
        'date_probable_signature',
        'reference_lettre_dnccp',
        'date_signature_reponse',
        'ano_id',
        'date_ouverture_offres',
        'delai_evaluation',
        'statut',
        'temps_traitement',
        'dossier_parent_id',
        'type_version_id',
        'numero_bordereau',
        'created_by'
    ];

    protected $casts = [
        'date_reception' => 'date',
        'date_prevision_ppm' => 'date',
        'date_limite_dn' => 'date',
        'date_probable_signature' => 'date',
        'date_signature_reponse' => 'date',
        'date_ouverture_offres' => 'date',
    ];

    public function autorite()
    {
        return $this->belongsTo(Autorite::class);
    }

    public function nature()
    {
        return $this->belongsTo(Nature::class);
    }

    public function ano()
    {
        return $this->belongsTo(Ano::class);
    }

    public function typeversion()
    {
        return $this->belongsTo(TypeVersion::class);
    }

    public function personnels()
    {
        return $this->belongsToMany(
            Personnel::class,
            'dossier_personnel'
        )->withPivot('role_dans_dossier')
            ->withTimestamps();
    }

    public function entites()
    {
        return $this->belongsToMany(
            Entite::class,
            'dossier_entite'
        )->withPivot('type')
            ->withTimestamps();
    }

    public function instructions()
    {
        return $this->belongsToMany(
            Instruction::class,
            'dossier_instruction'
        )->withTimestamps();
    }
}
