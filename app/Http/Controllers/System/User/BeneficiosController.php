<?php

namespace App\Http\Controllers\System\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BeneficiosController extends Controller
{
    public function index()
    {
        return view('system.user.beneficios.index', [
            'beneficios' => Auth::user()->beneficio->map(function ($beneficio){
                return [
                    'id' => base64_encode($beneficio->id),
                    'nome' => $beneficio->nome,
                    'tipo' => $beneficio->definirValorTipo()
                ];
            }),
        ]);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }
}