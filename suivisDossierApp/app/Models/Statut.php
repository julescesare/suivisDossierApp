<?php

namespace App\Models;

use App\Enums\StatutColor;
use Illuminate\Database\Eloquent\Model;

class Statut extends Model
{
    protected $fillable = [
        'libelle',
        'description',
        'couleur',
        'couleur_hex',
        'created_by'
    ];

    public function dossiers()
    {
        return $this->hasMany(Dossier::class);
    }

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'couleur' => StatutColor::class,
        ];
    }

    /**
     * Retourne la classe CSS du badge ou null si custom
     */
    public function badgeClass(): ?string
    {
        return $this->couleur?->badgeClass();
    }

    /**
     * Retourne le style inline si couleur custom, null sinon
     */
    public function badgeStyle(): ?string
    {
        if ($this->couleur === StatutColor::CUSTOM && $this->couleur_hex) {
            return 'background-color: ' . $this->couleur_hex;
        }

        return null;
    }
}
