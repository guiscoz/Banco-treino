<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UserRequest extends FormRequest
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
        return [
            'name' => 'required',
            'email' => 'required|email:rfc',
            'password' => 'required|confirmed'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Você precisa inserir o nome do usuário',
            'email.required' => 'Você precisa inserir o email do usuário',
            'email.email' => 'Email inválido!',
            'password.required' => 'Você precisa inserir a senha do usuário',
            'password.confirmed' => 'A senha precisa ser confirmada',
        ]; 
    }
}
