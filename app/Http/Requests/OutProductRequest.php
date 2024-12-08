<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @property mixed $product_id
 */
class OutProductRequest extends FormRequest
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
            'quantity' => 'required|integer|min:1',
            'product_id' => 'required|integer|exists:products,id',
        ];
    }

    public function messages(): array
    {
        return [
            'quantity.required' => 'La quantité est obligatoire.',
            'quantity.integer' => 'La quantité doit être un entier positif.',
            'quantity.min' => 'La quantité doit être d\'au moins 1.',
            'product_id.required' => 'L\'article est obligatoire.',
            'product_id.exists' => 'L\'article sélectionné n\'existe pas.',
        ];
    }
}
