<?php

namespace App\Models\System\User;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

    public function formatar_capital_social()
    {
        return number_format($this->capital_social / 100, 2, ',', '.');
    }

    function formatarTelefoneSemDDD($telefone)
    {
        $input = $telefone == 1 ? $this->telefone1 : $this->telefone2;
        if (!is_null($input)) {
            $numero = preg_replace('/\D/', '', $input);
            $formato = (strlen($numero) <= 8) ? 'XXXX-XXXX' : 'XXXXX-XXXX';
            $telefoneFormatado = '';
            $j = 0;

            for ($i = 0; $i < strlen($formato); $i++) {
                if ($formato[$i] === 'X') {
                    if ($j < strlen($numero)) {
                        $telefoneFormatado .= $numero[$j];
                        $j++;
                    }
                } else {
                    $telefoneFormatado .= $formato[$i];
                }
            }

            return $telefoneFormatado;
        } else {
            return '';
        }
    }
}
