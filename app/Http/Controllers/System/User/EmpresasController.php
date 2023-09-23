<?php

namespace App\Http\Controllers\System\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

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


    public function update(Request $request, string $id)
    {
        //
    }
}
