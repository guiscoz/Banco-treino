<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class LimitRequest extends FormRequest
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
        $usersPerPage = ['required', 'integer'];

        return [
            'usersPerPage' => $usersPerPage,
        ];
    }

    public function messages()
    {
        return [
            'usersPerPage.required' => 'Você precisa inserir um nome para este item',
            // 'usersPerPage.min' => 'Coloque um número maior',
            // 'usersPerPage.max' => 'Coloque um número menor',
        ];
    }
}
