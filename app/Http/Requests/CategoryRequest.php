<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|unique:categories|max:255',
            'description' => 'required|string|max:255',
        ];
    }

    public function messages(): array{
        return [
            'name.required' => 'Le champ nom est obligatoire',
            'name.string' => 'Le champ nom doit être une chaîne de caractères',
            'name.unique' => 'Le champ nom que vous avez renseigné existe déjà dans la base de données',
            'name.max' => 'Le champ de nom doit contenir au maximum 255 lettres',
            'description.required' => 'Le champ description est obligatoire',
            'description.string' => 'Le champ description doit obligatoirement être une chaine de caractères',
            'description.max' => 'Le champs de nom doit contenir au maximum 255 lettres'
        ];
    }
}
