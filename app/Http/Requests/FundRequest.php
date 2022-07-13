<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class FundRequest extends FormRequest
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
            'ammount' => 'required|numeric|min:0',
        ];
    }

    public function messages()
    {
        return [
            'ammount.required' => 'Você precisa inserir o valor da transação para continuar',
            'ammount.numeric' => 'O valor da transação precisa ser numérico',
            'ammount.min' => 'Se você quiser retirar dinheiro da sua conta, selecione a opção Retirar do formulário.',
        ]; 
    }
}
