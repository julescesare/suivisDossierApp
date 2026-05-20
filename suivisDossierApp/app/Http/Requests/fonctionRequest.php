<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class fonctionRequest extends FormRequest
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
            'nom' => 'required|string|max:255|unique:entites,nom,' . optional($this->route('entite'))->id,
            'description' => 'required|string',
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
        ];
    }
}
