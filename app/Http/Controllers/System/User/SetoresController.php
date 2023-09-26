<?php

namespace App\Http\Controllers\System\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\System\User\Setor\Cadastrar;
use App\Http\Requests\System\User\Setor\Editar;
use App\Models\System\User\Setor;

class SetoresController extends Controller
{
    public function index()
    {
        try {
            $usuario = Auth::user();
            $setores = $usuario->setores;
            return view('system.user.setores.index', ['setores' => $setores, 'usuario' => $usuario]);
        } catch (\Throwable $th) {
            return Redirect::back()->withErrors(['Ops! Houve um problema ao acessar a página :(']);
        }
    }

    public function create()
    {
        return view('system.user.setores.create');
    }

    public function store(Cadastrar $request)
    {
        try {
            $dados = $request->all();
            $dados['user_id'] = Auth::user()->id;
            $setor = Setor::create($dados);
            return redirect(route('sistema.usuario.setores.entrar'))->with('success', 'Parabéns ' . $setor->user->name . ', o setor ' . $setor->nome . ' foi cadastrado com sucesso!');
        } catch (\Throwable $th) {
            return Redirect::back()->withErrors(['Ops! Houve um problema ao cadastrar setor.']);
        }
    }

    public function edit(string $id)
    {
        try {
            return view('system.user.setores.edit', ['setor' => Setor::findOrFail(base64_decode($id))]);
        } catch (\Throwable $th) {
            return Redirect::back()->withErrors(['Ops! Houve um problema ao acessar a página :(']);
        }
    }

    public function update(Editar $request, string $id)
    {
        try {
            $dados = $request->all();
            $setor = Setor::findOrFail(base64_decode($id));
            $setor->update($dados);
            return redirect(route('sistema.usuario.setores.entrar'))->with('success', 'Parabéns ' . $setor->user->name . ', o setor ' . $setor->nome . ' foi atualizado com sucesso!');
        } catch (\Throwable $th) {
            return Redirect::back()->withErrors(['Ops! Houve um problema ao atualizar setor.']);
        }
    }

    public function destroy(string $id)
    {
        try {
            Setor::findOrFail(base64_decode($id))->delete();
            return redirect(route('sistema.usuario.setores.entrar'))->with('success', 'Parabéns! Setor excluído com sucesso!');
        } catch (\Throwable $th) {
            return Redirect::back()->withErrors(['Ops! Houve um problema ao excluir setor.']);
        }
    }
}
