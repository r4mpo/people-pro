<?php

namespace App\Http\Controllers\System\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\System\User\Empresa\EditarRequest as Editar;
use App\Models\System\User\Empresa;

class EmpresasController extends Controller
{
    public function index()
    {
        try {
            $usuario = Auth::user();
            $empresa = $usuario->empresa;
            return view('system.user.empresa.index', ['empresa' => $empresa, 'usuario' => $usuario]);
        } catch (\Throwable $th) {
            return Redirect::back()->withErrors(['Ops! Houve um problema ao acessar a página :(']);
        }
    }


    public function update(Editar $request, string $id)
    {
        try {
            $empresa = Empresa::findOrFail(base64_decode($id));
            $empresa->update($request->all());
            return Redirect::back()->with('success', 'Informações da empresa "' . $empresa->razao_social . '" foram atualizadas com sucesso.');
        } catch (\Throwable $th) {
            dd($th->getMessage());
            return Redirect::back()->withErrors(["Ops, " . Auth::user()->name . ', aparentemente houve um erro ao editar os dados de sua empresa.']);
        }
        dd($request->all());
    }
}
