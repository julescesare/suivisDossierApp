<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class AnoRequest extends FormRequest
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
            'avis' => 'required|string|max:255|unique:anos,avis,' . $this->route('ano')->id,
            'description' => 'required|string',
        ];
    }
    /**
     * Custom validation messages.
     */
    public function messages(): array
    {
        return [

            'avis.required' => 'Le titre de l’avis est obligatoire.',

            'avis.string' => 'Le titre de l’avis doit être une chaîne de caractères.',

            'avis.max' => 'Le titre de l’avis ne doit pas dépasser 255 caractères.',

            'description.required' => 'La description de l’avis est obligatoire.',

            'description.string' => 'La description doit être un texte valide.',

        ];
    }
}
