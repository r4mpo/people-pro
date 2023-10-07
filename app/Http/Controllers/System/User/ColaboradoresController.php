<?php

namespace App\Http\Controllers\System\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\System\User\Colaborador\Cadastrar;
use App\Http\Requests\System\User\Colaborador\Editar;
use App\Models\System\User\Colaborador;
use Exception;

class ColaboradoresController extends Controller
{
    public function index()
    {
        try {

            $usuario = Auth::user();
            $colaboradores = $usuario->colaboradores;
            return view('system.user.colaboradores.index', ['colaboradores' => $colaboradores, 'usuario' => $usuario]);
        } catch (\Throwable $th) {
            return Redirect::back()->withErrors(['Ops! Houve um problema ao acessar a página :(']);
        }
    }

    public function create()
    {
        return view('system.user.colaboradores.create', [
            'cargos' => Auth::user()->cargos,
            'situacoes' => Colaborador::SITUACOES,
            'escolaridades' => Colaborador::ESCOLARIDADES,
        ]);
    }

    public function store(Cadastrar $request)
    {
        try {
            $dados = $request->all();
            $dados['user_id'] = Auth::user()->id; 
            $colaborador = Colaborador::create($dados);
            return redirect(route('sistema.usuario.colaboradores.entrar'))->with('success', 'Parabéns ' . $colaborador->user->name . ', o colaborador ' . $colaborador->nome . ' foi cadastrado com sucesso!');
        } catch (\Throwable $th) {
            dd($th->getMessage());
            return Redirect::back()->withErrors(['Ops! Houve um problema ao cadastrar colaborador.']);
        }
    }

    public function edit(string $id)
    {
        try {
            return view('system.user.colaboradores.edit', ['colaborador' => Colaborador::findOrFail(base64_decode($id)), 
            'cargos' => Auth::user()->cargos,
            'situacoes' => Colaborador::SITUACOES,
            'escolaridades' => Colaborador::ESCOLARIDADES,
        ]);
        } catch (\Throwable $th) {
            return Redirect::back()->withErrors(['Ops! Houve um problema ao acessar a página :(']);
        }
    }

    public function update(Editar $request, string $id)
    {
        try {
            $dados = $request->all();
            $colaborador = Colaborador::findOrFail(base64_decode($id));
            $colaborador->user_id == Auth::user()->id ? $colaborador->update($dados) : throw new Exception('Hahaha! Boa tentativa. Não se pode modificar dados de terceiros.');
            return redirect(route('sistema.usuario.colaboradores.entrar'))->with('success', 'Parabéns ' . $colaborador->user->name . ', o colaborador ' . $colaborador->nome . ' foi atualizado com sucesso!');
        } catch (\Throwable $th) {
            return Redirect::back()->withErrors(['Ops! Houve um problema ao atualizar colaborador.']);
        }
    }

    public function destroy(string $id)
    {
        try {
            $colaborador = Colaborador::findOrFail(base64_decode($id));
            $colaborador->user_id == Auth::user()->id ? $colaborador->delete() : throw new Exception('Hahaha! Boa tentativa. Não se pode modificar dados de terceiros.');
            return redirect(route('sistema.usuario.colaboradores.entrar'))->with('success', 'Parabéns! Colaborador excluído com sucesso!');
        } catch (\Throwable $th) {
            return Redirect::back()->withErrors(['Ops! Houve um problema ao excluir colaborador.']);
        }
    }
}
