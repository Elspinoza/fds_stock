<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'name' => 'required|string|unique:products|max:255',
            'description' => 'sometimes|string|max:255',
            'available_quantity' => 'required|integer|min:1|positive',
            'category_id' => 'required|integer|exists:categories,id',
        ];
    }

    public function messages(): array{
        return [
            'name.required' => 'Le nom de l\'article est obligatoire',
            'name.string' => 'Le nom de l\'article doit obligatoirement être une chaine de caractère',
            'name.unique' => 'Le nom de l\'article que vous avez renseigné existe déjà dans la base de données',
            'name.max' => 'Le nom de l\'article ne doit pas excéder 255 chiffres',
            'description.string' => 'La description de l\'article doit obligatoirement être une chaine de caractère',
            'description.max' => 'La description de l\'article ne doit pas excéder 255 chiffres',
            'available_quantity.required' => 'La quantité de l\'article est obligatoire',
            'available_quantity.integer' => 'La quantité de l\'article doit obligatoirement être un chiffre',
            'available_quantity.min' => 'La quantité minimum d\'une article à enregistrer est 1',
            'available_quantity.positive' => 'La quantité doit obligatoirement être positif',
            'category_id.required' => 'L\'ID de la catégorie est obligatoire',
            'category_id.integer' => 'L\'ID de la catégorie doit être un chiffre',
        ];
    }
}
