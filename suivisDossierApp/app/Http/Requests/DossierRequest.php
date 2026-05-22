<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DossierRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        // Si on est en update, les champs requis deviennent "sometimes"
        $required = $this->isMethod('PUT') || $this->isMethod('PATCH')
            ? 'sometimes|required'
            : 'required';

        return [
            // --- Champs simples ---
            'numero_reception'               => [$required, 'string', 'max:255'],
            'objet'                          => [$required, 'string', 'max:500'],
            'numero_bordereau'               => ['nullable', 'string', 'max:255'],
            'respect_ppm'                    => ['nullable', 'boolean'],
            'delai_evaluation'               => ['nullable', 'integer', 'min:0'],
            'temps_traitement'               => ['nullable', 'integer', 'min:0'],
            'reference_lettre_dnccp'         => ['nullable', 'string', 'max:255'],

            // --- Clés étrangères ---
            'autorite_id'                    => [$required, 'exists:autorites,id'],
            'nature_id'                      => [$required, 'exists:natures,id'],
            'statut_id'                      => [$required, 'exists:statuts,id'],
            'ano_id'                         => ['nullable', 'exists:anos,id'],
            'type_version_id'                => ['nullable', 'exists:type_versions,id'],
            'dossier_parent_id'              => ['nullable', 'exists:dossiers,id'],

            // --- Dates ---
            'date_reception'                 => [$required, 'date'],
            'date_prevision_ppm'             => ['nullable', 'date'],
            'date_limite_dn'                 => ['nullable', 'date'],
            'date_probable_signature'        => ['nullable', 'date', 'after_or_equal:date_reception'],
            'date_signature_reponse'         => ['nullable', 'date', 'after_or_equal:date_reception'],
            'date_ouverture_offres'          => ['nullable', 'date'],

            // --- Relations N:N ---
            'personnels'                     => ['nullable', 'array'],
            'personnels.*.id'                => ['required_with:personnels', 'exists:personnels,id'],
            'personnels.*.role_dans_dossier' => ['required_with:personnels', 'string', 'max:255'],

            'entites'                        => ['nullable', 'array'],
            'entites.*.id'                   => ['required_with:entites', 'exists:entites,id'],
            'entites.*.type'                 => ['required_with:entites', 'string', 'max:255'],

            'instructions'                   => ['nullable', 'array'],
            'instructions.*'                 => ['integer', 'exists:instructions,id'],
        ];
    }

    public function messages(): array
    {
        return [
            'numero_reception.required'                    => 'Le numéro de réception est obligatoire.',
            'objet.required'                               => 'L\'objet du dossier est obligatoire.',
            'autorite_id.required'                         => 'L\'autorité est obligatoire.',
            'autorite_id.exists'                           => 'L\'autorité sélectionnée est invalide.',
            'nature_id.required'                           => 'La nature est obligatoire.',
            'nature_id.exists'                             => 'La nature sélectionnée est invalide.',
            'statut_id.required'                           => 'Le statut est obligatoire.',
            'statut_id.exists'                             => 'Le statut sélectionné est invalide.',
            'date_reception.required'                      => 'La date de réception est obligatoire.',
            'date_reception.date'                          => 'La date de réception est invalide.',
            'date_probable_signature.after_or_equal'       => 'La date de signature doit être après la date de réception.',
            'date_signature_reponse.after_or_equal'        => 'La date de signature réponse doit être après la date de réception.',
            'dossier_parent_id.exists'                     => 'Le dossier parent sélectionné est invalide.',
            'personnels.*.id.exists'                       => 'Un personnel sélectionné est invalide.',
            'personnels.*.role_dans_dossier.required_with' => 'Le rôle est obligatoire pour chaque personnel.',
            'entites.*.id.exists'                          => 'Une entité sélectionnée est invalide.',
            'entites.*.type.required_with'                 => 'Le type est obligatoire pour chaque entité.',
            'instructions.*.exists'                        => 'Une instruction sélectionnée est invalide.',
        ];
    }
}
