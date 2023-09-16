<?php

namespace App\Console\Commands\System\Admin;

use App\Models\System\User\Beneficio;
use Illuminate\Console\Command;

class GerarBeneficiosNoBancoDeDados extends Command
{
    protected $signature = 'app:gerar-beneficios-no-banco-de-dados';
    protected $description = 'Este comando, basicamente, serve para popularmos a tabela principal de benefícios com informações pesquisadas pelos desenvolvedores.';

    public function handle()
    {
        foreach (Beneficio::LISTA_BENEFICIOS_MAIS_COMUNS as $beneficio) {
            Beneficio::create($beneficio);
        }
    }
}