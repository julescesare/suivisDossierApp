<?php

namespace App\Http\Requests;

use App\Enums\StatutColor;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;

class StatutRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'libelle' => 'required|string|max:255|unique:natures,libelle,' . optional($this->route('nature'))->id,
            'description' => 'required|string',
            // couleur_hex obligatoire uniquement si couleur = 'custom'
            'couleur_hex' => [
                Rule::requiredIf(fn() => $this->couleur === StatutColor::CUSTOM->value),
                'nullable',
                'string',
                'size:7',
                'regex:/^#[0-9A-Fa-f]{6}$/',
            ],
            'couleur' => ['required', new Enum(StatutColor::class)]
        ];
    }
    /**
     * Custom validation messages.
     */
    public function messages(): array
    {
        return [
            'couleur_hex.required' => 'Le code hex est obligatoire pour une couleur personnalisée.',
            'couleur_hex.size'     => 'Le code hex doit faire exactement 7 caractères (ex: #FF0000).',
            'couleur_hex.regex'    => 'Le format du code hex est invalide (ex: #FF0000).',

            'libelle.required' => 'Le libellé du type de version est obligatoire.',

            'libelle.string' => 'Le libellé du type de version doit être une chaîne de caractères.',

            'libelle.unique' => 'Le libellé du type de version existe déjà.',

            'libelle.max' => 'Le libellé du type de version ne doit pas dépasser 255 caractères.',

            'description.required' => 'La description du type de version est obligatoire.',

            'description.string' => 'La description doit être un texte valide.',
            'couleur.required' => 'La couleur du statut est obligatoire.',

        ];
    }
}
