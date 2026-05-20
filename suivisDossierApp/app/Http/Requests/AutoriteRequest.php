<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class AutoriteRequest extends FormRequest
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
            'nom' => 'required|string|max:255|unique:autorites,nom,' . optional($this->route('autorite'))->id,
            'description' => 'nullable|string',
            'telephone' => 'required|string|max:20',
            'email' => 'required|email|max:255|unique:autorites,email,' . optional($this->route('autorite'))->id,

        ];
    }
    /**
     * Custom validation messages.
     */
    public function messages(): array
    {
        return [

            'nom.required' => 'Le nom de l’autorité est obligatoire.',

            'nom.string' => 'Le nom de l’autorité doit être une chaîne de caractères.',

            'nom.max' => 'Le nom de l’autorité ne doit pas dépasser 255 caractères.',
            'telephone.required' => 'Le numéro de téléphone est obligatoire.',
            'telephone.string' => 'Le numéro de téléphone doit être une chaîne de caractères.',
            'telephone.max' => 'Le numéro de téléphone ne doit pas dépasser 20 caractères.',
            'email.required' => 'L’adresse e-mail est obligatoire.',
            'email.email' => 'L’adresse e-mail doit être une adresse e-mail valide.',
            'email.unique' => 'L’adresse e-mail est déjà utilisée.',

        ];
    }
}
