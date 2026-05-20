<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class InstructionRequest extends FormRequest
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
            'contenu' => 'required|string|max:255|unique:instructions,contenu,' . optional($this->route('instruction'))->id,
        ];
    }
    /**
     * Custom validation messages.
     */
    public function messages(): array
    {
        return [

            'contenu.required' => 'Le contenu de l’instruction est obligatoire.',

            'contenu.string' => 'Le contenu de l’instruction doit être une chaîne de caractères.',

            'contenu.max' => 'Le contenu de l’instruction ne doit pas dépasser 255 caractères.',

        ];
    }
}
