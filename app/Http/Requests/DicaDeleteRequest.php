<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DicaDeleteRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'userId' => ['required', 'integer', 'exists:users,id']
        ];
    }

    public function messages()
    {
        return [
            'required' => 'O campo :attribute é obrigatório.',
            'tipo.exists' => 'Campo :attribute inválido.',
            'userId.integer' => 'O campo :attribute deve ser um número inteiro',
        ];
    }
}
