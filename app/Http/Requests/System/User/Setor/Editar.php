<?php

namespace App\Http\Requests\System\User\Setor;

use Illuminate\Foundation\Http\FormRequest;

class Editar extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nome' => ['min:5', 'max:100'],
        ];
    }

    public function messages()
    {
        return [
            'min' => "Ops! O campo :attribute precisa receber ao menos :min caracteres. Tente novamente.",
            'max' => "Ops! O campo :attribute precisa receber no máximo :max caracteres. Tente novamente.",
        ];
    }
}
