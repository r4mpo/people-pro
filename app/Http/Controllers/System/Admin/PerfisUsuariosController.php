<?php

namespace App\Http\Controllers\System\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;


class PerfisUsuariosController extends Controller
{
    public function index()
    {
        return view('system.admin.perfis.users.index', [
            'perfis' => Role::all(),
            'users' => User::all()->map(function ($user) {
                return [
                    'id' => $user->id,
                    'nome' => $user->name,
                    'email' => $user->email,
                    'empresa' => $user->empresa->razao_social,
                    'perfil' => $user->getRoleNames()->first(),
                ];
            }),
        ]);
    }

    public function edit($id, Request $request)
    {
        try {
            $novoCargo = $request->role;
            $user = User::findOrFail(base64_decode($id));
            $antigoCargo = $user->getRoleNames()->first();

            if($antigoCargo){
                $user->removeRole($antigoCargo);
            }
            
            $user->assignRole($novoCargo);
            return redirect(route('system.admin.perfis.usuarios.index'))->with('success', 'Cargo de ' . $novoCargo . ' foi atribuído com sucesso para ' . $user->name);
        } catch (\Throwable $th) {
            dd($th->getMessage());
            return redirect(route('system.admin.perfis.usuarios.index'))->withErrors(['Houve um erro ao editar perfil do usuário.']);
        }
    }
}
