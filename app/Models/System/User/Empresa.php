<?php

namespace App\Models\System\User;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Empresa extends Model
{
    use HasFactory;

    protected $fillable = [
        // Informações básicas da empresa
        'cnpj_raiz',
        'razao_social',
        'capital_social',
        'nome_fantasia',
        'situacao_cadastral',
        'data_inicio_atividade',

        // Endereço da empresa
        "logradouro",
        "numero",
        "complemento",
        "bairro",
        "cep",
        "cidade",

        // Contato
        "ddd1",
        "telefone1",
        "ddd2",
        "telefone2",

        // Usuário relacionado à empresa
        "user_id",
    ];


    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
