<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class EntiteRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
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
            'nom' => 'required|string|max:255|unique:entites,nom,' . optional($this->route('entite'))->id,
            'description' => 'required|string',
            'nom_court' => 'required|string|max:255|unique:entites,nom_court,' . optional($this->route('entite'))->id,
        ];
    }
    /**
     * Custom validation messages.
     */
    public function messages(): array
    {
        return [

            'nom.required' => 'Le nom de l\'entité est obligatoire.',

            'nom.string' => 'Le nom de l\'entité doit être une chaîne de caractères.',

            'nom.unique' => 'Le nom de l\'entité existe déjà.',

            'nom.max' => 'Le nom de l\'entité ne doit pas dépasser 255 caractères.',

            'description.required' => 'La description de l\'entité est obligatoire.',

            'description.string' => 'La description doit être un texte valide.',

            'nom_court.required' => 'Le nom court de l\'entité est obligatoire.',

            'nom_court.string' => 'Le nom court de l\'entité doit être une chaîne de caractères.',

            'nom_court.unique' => 'Le nom court de l\'entité existe déjà.',

            'nom_court.max' => 'Le nom court de l\'entité ne doit pas dépasser 255 caractères.',
        ];
    }
}
