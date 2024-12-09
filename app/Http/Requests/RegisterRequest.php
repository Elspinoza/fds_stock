<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'name' => 'required|string|unique:users,name',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|confirmed',
        ];
    }

    public function messages(): array{
        return [
            'name.required' => 'Le nom est obligatoire',
            'name.string' => 'Le nom doit obligatoirement être une chaine de caractère',
            'name.unique' => 'Le nom que vous avez renseigné existe déjà dans la base de données',
            'email.required' => 'L\'email est obligatoire',
            'email.unique' => 'L\'email que vous avez renseigné existe déjà dans la base de données',
            'password.required' => 'Le mot de passe est obligatoire',
            'password.confirmed' => 'Les mots de passe ne correspondent pas',
        ];
    }
}
