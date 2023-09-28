<?php

namespace App\Http\Controllers\System\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\System\User\Cargo\Cadastrar;
use App\Http\Requests\System\User\Cargo\Editar;
use App\Models\System\User\Cargo;
use Exception;

class CargosController extends Controller
{
    public function index()
    {
        try {
            $usuario = Auth::user();
            $cargos = $usuario->cargos;
            $cargos = $usuario->cargos;
            return view('system.user.cargos.index', ['cargos' => $cargos, 'usuario' => $usuario]);
        } catch (\Throwable $th) {
            return Redirect::back()->withErrors(['Ops! Houve um problema ao acessar a página :(']);
        }
    }

    public function create()
    {
        return view('system.user.cargos.create', ['setores' => Auth::user()->setores]);
    }

    public function store(Cadastrar $request)
    {
        try {
            $dados = $request->all();
            $dados['user_id'] = Auth::user()->id;
            $cargo = Cargo::create($dados);
            return redirect(route('sistema.usuario.cargos.entrar'))->with('success', 'Parabéns ' . $cargo->user->name . ', o cargo ' . $cargo->nome . ' foi cadastrado com sucesso!');
        } catch (\Throwable $th) {
            return Redirect::back()->withErrors(['Ops! Houve um problema ao cadastrar cargo.']);
        }
    }

    public function edit(string $id)
    {
        try {
            return view('system.user.cargos.edit', ['cargo' => Cargo::findOrFail(base64_decode($id)), 'setores' => Auth::user()->setores]);
        } catch (\Throwable $th) {
            return Redirect::back()->withErrors(['Ops! Houve um problema ao acessar a página :(']);
        }
    }

    public function update(Editar $request, string $id)
    {
        try {
            $dados = $request->all();
            $cargo = Cargo::findOrFail(base64_decode($id));
            $cargo->user_id == Auth::user()->id ? $cargo->update($dados) : throw new Exception('Hahaha! Boa tentativa. Não se pode modificar dados de terceiros.');
            return redirect(route('sistema.usuario.cargos.entrar'))->with('success', 'Parabéns ' . $cargo->user->name . ', o cargo ' . $cargo->nome . ' foi atualizado com sucesso!');
        } catch (\Throwable $th) {
            return Redirect::back()->withErrors(['Ops! Houve um problema ao atualizar cargo.']);
        }
    }

    public function destroy(string $id)
    {
        try {
            $cargo = Cargo::findOrFail(base64_decode($id));
            $cargo->user_id == Auth::user()->id ? $cargo->delete() : throw new Exception('Hahaha! Boa tentativa. Não se pode modificar dados de terceiros.');
            return redirect(route('sistema.usuario.cargos.entrar'))->with('success', 'Parabéns! Setor excluído com sucesso!');
        } catch (\Throwable $th) {
            return Redirect::back()->withErrors(['Ops! Houve um problema ao excluir cargo.']);
        }
    }
}
