<?php

namespace App\Http\Controllers\System;

use App\Http\Controllers\Controller;
use App\Models\System\User\Beneficio;
use App\Models\System\User\Colaborador;
use App\Models\System\User\Setor;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DashboardsController extends Controller
{
    public function home()
    {
        $user = Auth::user();
        $dados = array();

        if ($user->hasRole(User::ROLE_PERMISSIONS_ADMIN)) {

            $dados['qtd_usuarios_sistema'] = count(User::all());
            $dados['qtd_colaboradores_ativos'] = count(Colaborador::where('situacao', Colaborador::SITUACAO_ATIVO)->get());
            $dados['qtd_colaboradores_inativos'] = count(Colaborador::where('situacao', Colaborador::SITUACAO_INATIVO)->get());
            $dados['beneficios'] = Beneficio::all();


            return view('system.admin.home', ['dados' => $dados]);
        } else {
            $empresa = $user->empresa;

            $dados['qtd_colaboradores_ativos'] = count(
                Colaborador::where('user_id', $user->id)
                    ->where('situacao', Colaborador::SITUACAO_ATIVO)
                    ->get()
            );

            $dados['qtd_colaboradores_inativos'] = count(
                Colaborador::where('user_id', $user->id)
                    ->where('situacao', Colaborador::SITUACAO_INATIVO)
                    ->get()
            );

            $dados['beneficios'] = $user->beneficio;

            $dados['existeColaboradores'] = count($user->colaboradores) >= 1;
            $dados['existeCargos'] = count($user->cargos) >= 1;

            $dados['info'] = "A empresa $empresa->nome_fantasia, portadora do cnpj: " . $empresa->formatarCNPJ() . ", residente no cep $empresa->cep, localizado na rua  $empresa->logradouro, número $empresa->numero  ($empresa->bairro - $empresa->complemento), é utilizadora dos nossos sistemas desde " .
                date('d/m/Y', strtotime($empresa->created_at)) . ", tendo começado suas atividades em " . date('d/m/Y', strtotime($empresa->data_inicio_atividade)) . ". " .
                "O contato telefônico principal é: (" . $empresa->ddd1 . ") " . $empresa->formatarTelefoneSemDDD(1) . ", tendo seu capital social como " . $empresa->formatar_capital_social() . " reais.";


            $dados['url_graficos'] = route('api.dashboards.informacoes_para_popular_graficos');
            $dados['token'] = $user->createToken('token-name')->plainTextToken;
            return view('system.user.home', ['dados' => $dados]);
        }
    }

    public function informacoes_para_popular_graficos()
    {
        $user = Auth::user();
        $dados = array();
        $cargos = $user->cargos;
        $setores = $user->setores;



        foreach ($cargos as $cargo) {
            $dados['cargos']['nomes_cargos'][] = $cargo->nome;
            $dados['cargos']['salarios_cargos'][] = ($cargo->remuneracao / 100);
            $dados['cargos']['qtd_colaboradores'][] = count($cargo->colaboradores);

            $colaboradores = Setor::findOrFail($cargo->setor_id)->cargos->flatMap(function ($cargo) {
                return $cargo->colaboradores;
            });
        }

        foreach ($setores as $setor) {
            $dados['setores']['nomes_setores'][] = $setor->nome;
            $dados['setores']['qtd_colaboradores_por_setor'][] = count($setor->cargos->flatMap(function ($cargo) {
                return $cargo->colaboradores;
            }));
        }

        return response()->json([
            'status' => 200,
            'message' => 'Informações para popular gráfico foram obtidas com sucesso.',
            'dados' => $dados,
        ]);
    }
}
