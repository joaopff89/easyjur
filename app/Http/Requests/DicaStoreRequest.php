<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DicaStoreRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'userId' => ['required', 'integer', 'exists:users,id'],
            'tipo' => ['required', 'string', 'exists:tipos,nome'],
            'marca' => ['required', 'string', 'min:3', 'max:100'],
            'modelo' => ['required', 'string', 'min:3', 'max:100'],
            'versao' => ['max:100'],
            'descricao' => ['required', 'string', 'min:3', 'max:100'],
        ];
    }

    public function messages()
    {
        return [
            'required' => 'O campo :attribute é obrigatório.',
            'string' => 'O campo :attribute deve ser um texto.',
            'min' => 'O campo :attribute deve ter no mínimo :min caracteres.',
            'max' => 'O campo :attribute não deve ser maior que :max caracteres.',
            'userId.exists' => 'Id de usuário inválido',
            'tipo.exists' => 'Campo :attribute inválido.',
            'userId.integer' => 'O campo :attribute deve ser um número inteiro',
        ];
    }
}
