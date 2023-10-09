<?php

namespace App\Http\Requests\System\User\Financeiro;

use Illuminate\Foundation\Http\FormRequest;

class Cadastrar extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'documento' => ['required', 'file', 'mimes:jpeg,png,pdf', 'max:2048'],
            'descricao' => ['required', 'min:10'],
        ];
    }

    public function messages()
    {
        return [
            'required' => 'O campo :attribute é obrigatório. Tente novamente.',
            'file' => 'O campo :attribute deve ser um arquivo. Tente novamente.',
            'mimes' => 'O campo :attribute deve ser um arquivo do tipo: jpeg, png, pdf. Tente novamente.',
            'max' => 'O campo :attribute não deve exceder :max. Tente novamente.',
            'min' => 'O campo :attribute não deve exceder :min. Tente novamente.',
        ];
    }
}
