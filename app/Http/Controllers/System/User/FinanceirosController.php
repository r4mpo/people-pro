<?php

namespace App\Http\Controllers\System\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\System\User\Financeiro\Cadastrar;
use App\Http\Requests\System\User\Financeiro\Editar;
use App\Models\System\User\Financeiro;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class FinanceirosController extends Controller
{

    public function index()
    {
        try {
            $usuario = Auth::user();
            $financeiros = $usuario->financeiros;
            return view('system.user.financeiros.index', ['financeiros' => $financeiros->map(function ($financeiro) {
                return [
                    'id' => $financeiro->id,
                    'descricao' => $financeiro->descricao,
                    'documento' => "http://" . $_SERVER['HTTP_HOST'] . "/documentos/system/financeiro/" . $financeiro->documento,
                ];
            }), 'usuario' => $usuario]);
        } catch (\Throwable $th) {
            return Redirect::back()->withErrors(['Ops! Houve um problema ao acessar a página :(']);
        }
    }

    public function create()
    {
        return view('system.user.financeiros.create');
    }

    public function store(Cadastrar $request)
    {
        try {

            $dados = $request->all();
            $dados['user_id'] = Auth::user()->id;

            if ($request->hasFile('documento') && $request->file('documento')->isValid()) {
                $requestDocumento = $request->documento;
                $extension = $requestDocumento->extension();
                $documentoName = md5($requestDocumento->getClientOriginalName() . strtotime("now") . "." . $extension);
                $request->documento->move(public_path('documentos/system/financeiro'), $documentoName);
                $dados['documento'] = $documentoName;
            }

            $financeiro = Financeiro::create($dados);
            return redirect(route('sistema.usuario.financeiros.entrar'))->with('success', 'Parabéns ' . $financeiro->user->name . ', o financeiro ' . $financeiro->descricao . ' foi cadastrado com sucesso!');
        } catch (\Throwable $th) {
            return Redirect::back()->withErrors(['Ops! Houve um problema ao cadastrar financeiro.']);
        }
    }


    public function edit(string $id)
    {
        try {
            return view('system.user.financeiros.edit', ['financeiro' => Financeiro::findOrFail(base64_decode($id))]);
        } catch (\Throwable $th) {
            return Redirect::back()->withErrors(['Ops! Houve um problema ao acessar a página :(']);
        }
    }

    public function update(Editar $request, string $id)
    {
        try {
            $dados = $request->all();
            $financeiro = Financeiro::findOrFail(base64_decode($id));
            if ($financeiro->user_id == Auth::user()->id) {
                if ($request->hasFile('documento') && $request->file('documento')->isValid()) {
                    if ($this->excluirArquivosFinanceiros($financeiro->documento)) {
                        $requestDocumento = $request->documento;
                        $extension = $requestDocumento->extension();
                        $documentoName = md5($requestDocumento->getClientOriginalName() . strtotime("now") . "." . $extension);
                        $request->documento->move(public_path('documentos/system/financeiro'), $documentoName);
                        $dados['documento'] = $documentoName;
                    } else {
                        throw new Exception('Ops! Houve um problema inesperado na exclusão do arquivo. Tente novamente.');
                    }
                }
                $financeiro->update($dados);
            } else {
                throw new Exception('Hahaha! Boa tentativa. Não se pode modificar dados de terceiros.');
            }
            return redirect(route('sistema.usuario.financeiros.entrar'))->with('success', 'Parabéns ' . $financeiro->user->name . ', o financeiro ' . $financeiro->descricao . ' foi atualizado com sucesso!');
        } catch (\Throwable $th) {
            return Redirect::back()->withErrors(['Ops! Houve um problema ao atualizar financeiro.']);
        }
    }

    public function destroy(string $id)
    {
        try {
            $financeiro = Financeiro::findOrFail(base64_decode($id));

            if ($financeiro->user_id == Auth::user()->id) {
                if ($this->excluirArquivosFinanceiros($financeiro->documento)) {
                    $financeiro->delete();
                } else {
                    throw new Exception('Ops! Houve um problema inesperado na exclusão do arquivo. Tente novamente.');
                }
            } else {
                throw new Exception('Hahaha! Boa tentativa. Não se pode modificar dados de terceiros.');
            }

            return redirect(route('sistema.usuario.financeiros.entrar'))->with('success', 'Parabéns! Financeiro excluído com sucesso!');
        } catch (\Throwable $th) {
            return Redirect::back()->withErrors(['Ops! Houve um problema ao excluir financeiro.']);
        }
    }


    public function excluirArquivosFinanceiros($arquivo)
    {
        try {
            if (file_exists(public_path("documentos/system/financeiro/$arquivo"))) {
                unlink(public_path("documentos/system/financeiro/$arquivo"));
                return true;
            } else {
                return true;
            }
        } catch (\Throwable $th) {
            return false;
        }
    }
}
