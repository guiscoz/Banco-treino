<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class BankRequest extends FormRequest
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
        $bankName = ['required'];
        $bankNumber = ['required', 'integer', 'digits:4'];
        $bankFund = ['required', 'numeric', 'min:0'];

        return [
            'bankName' => $bankName,
            'bankNumber' => $bankNumber, 
            'bankFund' => $bankFund,
        ];
    }

    public function messages()
    {
        return [
            'bankName.required' => 'Você precisa inserir o nome do banco',
            'bankNumber.required' => 'Você precisa inserir o número de sua conta',
            'bankNumber.integer' => 'O número da conta bancário precisa ser inteiro',
            'bankNumber.digits' => 'O número de sua conta precisa ter uns 4 dígitos',
            'bankFund.required' => 'Você precisa inserir o seu fundo bancário',
            'bankFund.numeric' => 'O valor do saldo precisa ser numérico',
            'bankFund.min' => 'É impossível ter um saldo negativo',
        ]; 
    }
}
