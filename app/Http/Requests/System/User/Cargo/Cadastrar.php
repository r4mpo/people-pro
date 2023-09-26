<?php

namespace App\Http\Requests\System\User\Cargo;

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
            'nome' => ['required', 'min:5', 'max:100'],
            'descricao' => ['required', 'min:5', 'max:200'],
            'remuneracao' => ['required'],
            'setor_id' => ['required', 'exists:setors,id']
        ];
    }

    public function messages()
    {
        return [
            'required' => "Ops! O campo :attribute é obrigatório. Tente novamente.",
            'min' => "Ops! O campo :attribute precisa receber ao menos :min caracteres. Tente novamente.",
            'max' => "Ops! O campo :attribute precisa receber no máximo :max caracteres. Tente novamente.",
            'exists' => "Ops! O campo :attribute que você enviou não se encontra em nossos registros internos. Tente novamente."
        ];
    }

    public function prepareForValidation()
    {
        $input = $this->all();

        if ($this->has('remuneracao'))
            $input['remuneracao'] = preg_replace("/[^0-9]/", "", $this->get('remuneracao'));

        $this->replace($input);
    }
}
