<?php

namespace App\Models\System\User;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Beneficio extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'tipo',
    ];

    const TIPO_BENEFICIO_ALIMENTACAO = 1;
    const TIPO_BENEFICIO_SAUDE = 2;
    const TIPO_BENEFICIO_TRANSPORTE = 3;
    const TIPO_BENEFICIO_PROFISSIONALIZANTE = 4;
    const TIPO_BENEFICIO_CULTURA = 5;
    const TIPO_BENEFICIO_PESSOAL = 6;

    const LISTA_BENEFICIOS_MAIS_COMUNS = [
        ['nome' => 'Vale-alimentação', 'tipo' => SELF::TIPO_BENEFICIO_ALIMENTACAO],
        ['nome' => 'Vale-refeição', 'tipo' => SELF::TIPO_BENEFICIO_ALIMENTACAO],
        ['nome' => 'Vale-combustível', 'tipo' => SELF::TIPO_BENEFICIO_TRANSPORTE],
        ['nome' => 'Plano odontológico e de saúde', 'tipo' => SELF::TIPO_BENEFICIO_SAUDE],
        ['nome' => 'Viagem de incentivo', 'tipo' => SELF::TIPO_BENEFICIO_PROFISSIONALIZANTE],
        ['nome' => 'Vale-cultura', 'tipo' => SELF::TIPO_BENEFICIO_CULTURA],
        ['nome' => 'VB Despesas', 'tipo' => SELF::TIPO_BENEFICIO_PESSOAL],
        ['nome' => 'VB Presente', 'tipo' => SELF::TIPO_BENEFICIO_PESSOAL],
    ];

    public function usuariosQuePossuemEsteBeneficio()
    {
        return $this->belongsToMany(User::class);
    }

    public function definirValorTipo()
    {
        switch ($this->tipo) {
            case 1:
                return 'Alimentação';
            case 2:
                return 'Saúde';
            case 3:
                return 'Transporte';
            case 4:
                return 'Profissionalizante';
            case 5:
                return 'Cultura';
            case 6:
                return 'Pessoal';
        }
    }
}
