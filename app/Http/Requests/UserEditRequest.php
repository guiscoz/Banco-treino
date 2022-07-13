<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UserEditRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {

        $name = ['required'];
        $email = ['required', 'email:rfc'];
        $password = ['nullable'];

        return [
            'name' => $name,
            'email' => $email,
            'password' => $password
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Você precisa inserir o nome do usuário',
            'email.required' => 'Você precisa inserir o email do usuário',
            'email.email' => 'Email inválido!',
        ]; 
    }
}
