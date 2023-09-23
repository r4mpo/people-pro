<?php

namespace App\Http\Controllers\System\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Redirect;

class BeneficiosController extends Controller
{
    public function index()
    {
        try {
            $usuario = Auth::user();
            $beneficios = $usuario->beneficio->map(function ($beneficio) {
                return [
                    'id' => base64_encode($beneficio->id),
                    'nome' => $beneficio->nome,
                    'tipo' => $beneficio->definirValorTipo()
                ];
            });

            return view('system.user.beneficios.index', ['beneficios' => $beneficios, 'usuario' => $usuario]);
        } catch (\Throwable $th) {
            return Redirect::back()->withErrors(['Ops! Houve um problema ao acessar a página :(']);
        }
    }

    public function vincular_beneficio_usuario_view()
    {
        try {
            $usuario = Auth::user();
            $beneficios = User::beneficiosNaoAtribuidosAoUsuario($usuario->id);
            return view('system.user.beneficios.vincular_beneficio_usuario', ['beneficios' => $beneficios, 'usuario' => $usuario]);
        } catch (\Throwable $th) {
            return Redirect::back()->withErrors(['Ops! Houve um problema ao acessar a página :(']);
        }
    }

    public function vincular_beneficio_usuario_exe(Request $request)
    {
        try {
            foreach ($request->beneficios as $beneficio_id) {
                Auth::user()->beneficio()->attach($beneficio_id);
            }
            return redirect(route('sistema.usuario.beneficios.entrar'))->with('success', "Benefícios adquiridos com sucesso! Parabéns, " . Auth::user()->name . '.');
        } catch (\Throwable $th) {
            return Redirect::back()->withErrors(["Ops, " . Auth::user()->name . ', aparentemente houve um erro ao adquirir os benefícios.']);
        }
    }

    public function desvincular_beneficio_usuario_exe(Request $request)
    {
        try {
            Auth::user()->beneficio()->detach($request->beneficio_id);
            return redirect(route('sistema.usuario.beneficios.entrar'))->with('success', "Benefícios desvinculados com sucesso! Parabéns, " . Auth::user()->name . '.');
        } catch (\Throwable $th) {
            return Redirect::back()->withErrors(["Ops, " . Auth::user()->name . ', aparentemente houve um erro ao desvincular os benefícios.']);
        }
    }
}