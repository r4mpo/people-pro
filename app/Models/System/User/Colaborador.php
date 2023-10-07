<?php

namespace App\Models\System\User;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Colaborador extends Model
{
    use HasFactory;

    protected $fillable = [
        "nome",
        "email",
        "cpf",
        "rg",
        "telefone",
        "situacao", // 1 - Ativo, 0 - Inativo
        "cargo_id",
        "user_id",
        "data_nascimento",
        "data_inicio",
        "data_fim",
        "qtd_dependentes",
        "escolaridade", // 1 - Fundamental incompleto, 2 - Fundamental Completo, 3 - Médio incompleto, 4 - Médio completo, 5 - Superior incompleto, 6 - Superior completo
        "logradouro",
        "numero",
        "complemento",
        "bairro",
        "cep",
        "cidade",
    ];

    const ESCOLARIDADE_FUNDAMENTAL_INCOMPLETO = 0;
    const ESCOLARIDADE_FUNDAMENTAL_COMPLETO = 1;
    const ESCOLARIDADE_MEDIO_INCOMPLETO = 2;
    const ESCOLARIDADE_MEDIO_COMPLETO = 3;
    const ESCOLARIDADE_SUPERIOR_INCOMPLETO = 4;
    const ESCOLARIDADE_SUPERIOR_COMPLETO = 5;

    const SITUACAO_ATIVO = 1;
    const SITUACAO_INATIVO = 0;

    const SITUACOES = [
        'ativo' => ['value' => SELF::SITUACAO_ATIVO, 'option' => 'Ativo'],
        'inativo' => ['value' => SELF::SITUACAO_INATIVO, 'option' => 'Inativo'],
    ];

    const ESCOLARIDADES = [
        'fundamental_incompleto' => ['value' => SELF::ESCOLARIDADE_FUNDAMENTAL_INCOMPLETO, 'option' => 'Ensino fundamental incompleto'],
        'fundamental_completo' => ['value' => SELF::ESCOLARIDADE_FUNDAMENTAL_COMPLETO, 'option' => 'Ensino fundamental completo'],
        'medio_incompleto' => ['value' => SELF::ESCOLARIDADE_MEDIO_INCOMPLETO, 'option' => 'Ensino médio incompleto'],
        'medio_completo' => ['value' => SELF::ESCOLARIDADE_MEDIO_COMPLETO, 'option' => 'Ensino médio completo'],
        'superior_incompleto' => ['value' => SELF::ESCOLARIDADE_SUPERIOR_INCOMPLETO, 'option' => 'Ensino superior incompleto'],
        'superior_completo' => ['value' => SELF::ESCOLARIDADE_SUPERIOR_COMPLETO, 'option' => 'Ensino superior completo'],
    ];

    public function user()
    {
        return $this->hasOne(User::class, "id", "user_id");
    }

    function formatarTelefone()
    {
        $telefone = preg_replace('/[^0-9]/', '', $this->telefone);
        $qtdDigitos = strlen($telefone);
        if ($qtdDigitos === 10) {
            return '(' . substr($telefone, 0, 2) . ') ' . substr($telefone, 2, 4) . '-' . substr($telefone, 6, 4);
        } elseif ($qtdDigitos === 11) {
            return '(' . substr($telefone, 0, 2) . ') ' . substr($telefone, 2, 5) . '-' . substr($telefone, 7, 4);
        } else {
            return $telefone;
        }
    }


    public function cargo()
    {
        return $this->hasOne(Cargo::class, "id", "cargo_id");
    }

    public function capturar_situacao()
    {
        return $this->situacao == SELF::SITUACAO_ATIVO ? "Ativo" : "Inativo";
    }

    public function capturar_escolaridade()
    {
        switch ($this->escolaridade) {
            case SELF::ESCOLARIDADE_FUNDAMENTAL_INCOMPLETO:
                return 'Ensino fundamental incompleto';
            case SELF::ESCOLARIDADE_FUNDAMENTAL_COMPLETO:
                return 'Ensino fundamental completo';
            case SELF::ESCOLARIDADE_MEDIO_INCOMPLETO:
                return 'Ensino médio incompleto';
            case SELF::ESCOLARIDADE_MEDIO_COMPLETO:
                return 'Ensino médio completo';
            case SELF::ESCOLARIDADE_SUPERIOR_INCOMPLETO:
                return 'Ensino superior incompleto';
            case SELF::ESCOLARIDADE_SUPERIOR_COMPLETO:
                return 'Ensino superior completo';
        }
    }

    function formatarCpf()
    {
        $cpf = preg_replace('/[^0-9]/', '', $this->cpf);
        return preg_replace('/(\d{3})(\d{3})(\d{3})(\d{2})/', '$1.$2.$3-$4', $cpf);
    }

    function formatarRg()
    {
        $rg = preg_replace('/[^0-9]/', '', $this->rg);
        return preg_replace('/(\d{2})(\d{3})(\d{3})(\d{1})/', '$1.$2.$3-$4', $rg);
    }
}
