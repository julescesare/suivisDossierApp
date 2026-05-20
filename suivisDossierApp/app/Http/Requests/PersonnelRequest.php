<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class PersonnelRequest extends FormRequest
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
            'nom' => 'required|string|max:255|unique:personnels,nom,' . optional($this->route('personnel'))->id,
            'prenom' => 'required|string|max:255',
            'fonction_id' => 'required|exists:fonctions,id',
            'telephone' => 'required|string|max:20',
            'email' => 'required|email|max:255|unique:personnels,email,' . optional($this->route('personnel'))->id,

        ];
    }
    /**
     * Custom validation messages.
     */
    public function messages(): array
    {
        return [

            'nom.required' => 'Le nom du personnel est obligatoire.',

            'nom.string' => 'Le nom du personnel doit être une chaîne de caractères.',

            'nom.max' => 'Le nom du personnel ne doit pas dépasser 255 caractères.',
            'prenom.required' => 'Le prénom du personnel est obligatoire.',
            'prenom.string' => 'Le prénom du personnel doit être une chaîne de caractères.',
            'prenom.max' => 'Le prénom du personnel ne doit pas dépasser 255 caractères.',
            'fonction_id.required' => 'La fonction du personnel est obligatoire.',
            'fonction_id.exists' => 'La fonction sélectionnée n’existe pas.',
            'telephone.required' => 'Le numéro de téléphone est obligatoire.',
            'telephone.string' => 'Le numéro de téléphone doit être une chaîne de caractères.',
            'telephone.max' => 'Le numéro de téléphone ne doit pas dépasser 20 caractères.',
            'email.required' => 'L’adresse e-mail est obligatoire.',
            'email.email' => 'L’adresse e-mail doit être une adresse e-mail valide.',
            'email.unique' => 'L’adresse e-mail est déjà utilisée.',

        ];
    }
}
