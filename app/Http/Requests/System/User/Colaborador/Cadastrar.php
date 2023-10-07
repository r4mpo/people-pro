<?php

namespace App\Http\Requests\System\User\Colaborador;

use Illuminate\Foundation\Http\FormRequest;

class Cadastrar extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $rules = [
            'nome' => ['required', 'min:5', 'max:100'],
            'email' => ['required', 'min:10', 'max:100', 'email'],
            'cargo_id' => ['required', 'exists:cargos,id'],
            'logradouro' => ['required', 'string'],
            'numero' => ['required'],
            'complemento' => ['nullable', 'string'],
            'bairro' => ['required', 'string'],
            'cep' => ['required'],
            'cidade' => ['required', 'string'],
            'telefone' => ['required'],
            'qtd_dependentes' => ['required'],
            'escolaridade' => ['required', 'in:0,1,2,3,4,5'],
            'situacao' => ['required', 'in:0,1'],
            'data_nascimento' => ['required', 'date', 'before:18 years ago'],
            'data_inicio' => [
                'required', 'date',
                function ($attribute, $value, $fail) {
                    $data_nascimento = $this->input('data_nascimento');
                    $minDataInicio = date('Y-m-d', strtotime($data_nascimento . ' +18 years'));
                    if ($value < $minDataInicio) {
                        $fail("A data de início deve ser ao menos 18 anos após a data de nascimento.");
                    }
                },
            ],
        ];

        // Se a situação for 0, a data_fim é obrigatória
        if ($this->input('situacao') == 0) {
            $rules['data_fim'] = ['required', 'date', 'after_or_equal:data_inicio'];
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'required' => "Ops! O campo :attribute é obrigatório. Tente novamente.",
            'min' => "Ops! O campo :attribute precisa receber ao menos :min caracteres. Tente novamente.",
            'max' => "Ops! O campo :attribute precisa receber no máximo :max caracteres. Tente novamente.",
            'exists' => "Ops! O campo :attribute que você enviou não se encontra em nossos registros internos. Tente novamente.",
            'email' => "Ops! O campo :attribute deve ser enviado com um endereço de e-mail válido.",
            'date' => "Ops! O campo :attribute deve ser enviado com um data válida.",

            'data_nascimento.before' => "O colaborador precisa ter ao menos 18 anos no momento do cadastro.",
            'data_fim.after_or_equal' => "A data de fim não pode ser anterior à data de início."
        ];
    }

    public function prepareForValidation()
    {
        $input = $this->all();

        if ($this->has('numero'))
            $input['numero'] = preg_replace("/[^0-9]/", "", $this->get('numero'));

        if ($this->has('cep'))
            $input['cep'] = preg_replace("/[^0-9]/", "", $this->get('cep'));

        if ($this->has('cpf'))
            $input['cpf'] = preg_replace("/[^0-9]/", "", $this->get('cpf'));

        if ($this->has('rg'))
            $input['rg'] = preg_replace("/[^0-9]/", "", $this->get('rg'));

        if ($this->get('situacao') == '1')
            $input['data_fim'] = null;

        if ($this->has('telefone'))
            $input['telefone'] = preg_replace("/[^0-9]/", "", $this->get('telefone'));

        if ($this->has('qtd_dependentes'))
            $input['qtd_dependentes'] = preg_replace("/[^0-9]/", "", $this->get('qtd_dependentes'));

        if ($this->has('escolaridade'))
            $input['escolaridade'] = preg_replace("/[^0-9]/", "", $this->get('escolaridade'));

        if ($this->has('escolaridade'))
            $input['escolaridade'] = preg_replace("/[^0-9]/", "", $this->get('escolaridade'));

        $this->replace($input);
    }
}
