<?php

namespace App\Http\Requests\System\User\Empresa;

use Illuminate\Foundation\Http\FormRequest;

class EditarRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'cnpj_raiz' => ['required', 'min:11'],
            'razao_social' => ['required', 'min:3'],
            'nome_fantasia' => ['nullable', 'min:3'],
            'data_inicio_atividade' => ['required', 'date'],
            "logradouro" => ['required'],
            "numero" => ['required'],
            "bairro" => ['required'],
            "cep" => ['required'],
            "cidade" => ['required'],
            "ddd1" => ['required'],
            "telefone1" => ['required'],
            'situacao_cadastral' => ['required'],
        ];
    }

    public function messages()
    {
        return [
            'required' => "Ops! O campo :attribute é obrigatório. Tente novamente.",
            'min' => "Ops! O campo :attribute precisa receber ao menos :min caracteres. Tente novamente.",
            'data_inicio_atividade.date' => 'Ops! O campo relacionado à data de início das atividades está em um formato inválido. Tente novamente.',
        ];
    }

    public function prepareForValidation()
    {
        $input = $this->all();

        if ($this->has('cnpj_raiz'))
            $input['cnpj_raiz'] = preg_replace("/[^0-9]/", "", $this->get('cnpj_raiz'));

        if ($this->has('situacao_cadastral'))
            $input['situacao_cadastral'] = $this->get('situacao_cadastral') == '1' ? 1 : 0;

        if ($this->has('capital_social'))
            $input['capital_social'] = preg_replace("/[^0-9]/", "", $this->get('capital_social'));

        if ($this->has('telefone1'))
            $input['telefone1'] = preg_replace("/[^0-9]/", "", $this->get('telefone1'));

        if ($this->has('ddd1'))
            $input['ddd1'] = preg_replace("/[^0-9]/", "", $this->get('ddd1'));

        if ($this->has('telefone2') && $this->get('telefone2') != '')
            $input['telefone2'] = preg_replace("/[^0-9]/", "", $this->get('telefone2'));

        if ($this->has('ddd2') && $this->get('ddd2') != '')
            $input['ddd2'] = preg_replace("/[^0-9]/", "", $this->get('ddd2'));

        $this->replace($input);
    }
}
