<?php

namespace App\Enums;

enum StatutColor: string
{
    // Couleurs Bootstrap
    case PRIMARY   = 'primary';
    case SUCCESS   = 'success';
    case DANGER    = 'danger';
    case WARNING   = 'warning';
    case INFO      = 'info';
    case SECONDARY = 'secondary';
    case DARK      = 'dark';
    case LIGHT     = 'light';

        // Couleur personnalisée (hex)
    case CUSTOM    = 'custom';

    /**
     * Label lisible affiché dans le formulaire
     */
    public function label(): string
    {
        return match ($this) {
            self::PRIMARY   => 'Bleu (Primary)',
            self::SUCCESS   => 'Vert (Success)',
            self::DANGER    => 'Rouge (Danger)',
            self::WARNING   => 'Jaune (Warning)',
            self::INFO      => 'Cyan (Info)',
            self::SECONDARY => 'Gris (Secondary)',
            self::DARK      => 'Noir (Dark)',
            self::LIGHT     => 'Blanc (Light)',
            self::CUSTOM    => 'Personnalisée',
        };
    }

    /**
     * Couleur hex approximative pour la preview visuelle
     */
    public function hex(): string
    {
        return match ($this) {
            self::PRIMARY   => '#0d6efd',
            self::SUCCESS   => '#198754',
            self::DANGER    => '#dc3545',
            self::WARNING   => '#ffc107',
            self::INFO      => '#0dcaf0',
            self::SECONDARY => '#6c757d',
            self::DARK      => '#212529',
            self::LIGHT     => '#f8f9fa',
            self::CUSTOM    => '#000000',
        };
    }

    /**
     * Classe CSS Bootstrap du badge
     * Si custom, on retourne null → le style inline sera utilisé
     */
    public function badgeClass(): ?string
    {
        if ($this === self::CUSTOM) {
            return null;
        }

        return 'bg-' . $this->value;
    }

    /**
     * Retourne tous les cas sauf CUSTOM
     * Utile pour afficher uniquement les couleurs Bootstrap dans le sélecteur
     */
    public static function bootstrapCases(): array
    {
        return array_filter(
            self::cases(),
            fn($case) => $case !== self::CUSTOM
        );
    }
}
