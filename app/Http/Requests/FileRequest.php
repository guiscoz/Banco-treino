<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class FileRequest extends FormRequest
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
        $txt = ['mimes:txt'];
        $image = ['image', 'mimes:png'];

        return [
            'txt' => $txt,
            'image' => $image,
        ];
    }

    public function messages()
    {
        return [
            'txt.mimes' => 'Formato errado!',
            'image.image' => 'Precisa ser uma imagem',
            'image.mimes' => 'Precisa ser um arquivo png',
        ];
    }
}
