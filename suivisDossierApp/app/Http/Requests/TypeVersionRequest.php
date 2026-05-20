<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class TypeVersionRequest extends FormRequest
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
            'libelle' => 'required|string|max:255|unique:type_versions,libelle,' . optional($this->route('typeVersion'))->id,
            'description' => 'required|string',
        ];
    }
    /**
     * Custom validation messages.
     */
    public function messages(): array
    {
        return [

            'libelle.required' => 'Le libellé du type de version est obligatoire.',

            'libelle.string' => 'Le libellé du type de version doit être une chaîne de caractères.',

            'libelle.unique' => 'Le libellé du type de version existe déjà.',

            'libelle.max' => 'Le libellé du type de version ne doit pas dépasser 255 caractères.',

            'description.required' => 'La description du type de version est obligatoire.',

            'description.string' => 'La description doit être un texte valide.',

        ];
    }
}
