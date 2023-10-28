<?php

namespace App\Http\Controllers\System\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PerfisAcessoController extends Controller
{
    public function index()
    {
        return view('system.admin.perfis.index', [
            'perfis' => Role::all()
        ]);
    }


    public function create()
    {
        return view('system.admin.perfis.create', [
            'permissoes' => Permission::all(),
            'rotas' => DB::table('permissions')->groupBy('rota')->get(),
            'menus' => DB::table('permissions')->groupBy('menu')->get(),
            'submenus' => DB::table('permissions')->groupBy('submenu')->get(),
        ]);
    }

    public function store(Request $request)
    {
        if (strpos($request->name, 'Administrador') !== false or strpos($request->name, 'User') !== false) {
            return Redirect::back()->withErrors(['Houve um erro. Não é possível manipular informações relacionadas ao administrador ou user e nem atribuir novos perfis denominados como administradores ou usuários padrão no sistema.']);
        }
        try {
            $role = Role::create([
                'name' => $request->name,
            ])->givePermissionTo($request->permissions); // atribuindo as permissões marcadas no formulário
            return redirect(route('system.admin.perfis.index'))->with('success', 'Perfil de acesso ' . $role->name . ' cadastrado com sucesso.');
        } catch (\Exception $e) {
            return redirect(route('system.admin.perfis.index'))->withErrors(['Houve um erro ao cadastrar o perfil de acesso.']);
        }
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $role = Role::findOrFail(base64_decode($id));
        return view('system.admin.perfis.edit', [
            'permissoes' => Permission::all(),
            'rotas' => DB::table('permissions')->groupBy('rota')->get(),
            'menus' => DB::table('permissions')->groupBy('menu')->get(),
            'submenus' => DB::table('permissions')->groupBy('submenu')->get(),
            'role' => $role
        ]);
    }

    public function update(Request $request, $id)
    {
        if (strpos($request->name, 'Administrador') !== false or strpos($request->name, 'User') !== false) {
            return Redirect::back()->withErrors(['Houve um erro. Não é possível manipular informações relacionadas ao administrador ou user e nem atribuir novos perfis denominados como administradores ou usuários padrão no sistema.']);
        }
        $role = Role::findOrFail(base64_decode($id));
        try {
            foreach ($role->permissions as $permission) {
                $role->revokePermissionTo($permission->name);
            }
            $role->update(['name' => $request->name]);
            $role->givePermissionTo($request->permissions);
            return redirect(route('system.admin.perfis.index'))->with('success', 'Perfil de acesso ' . $role->name . ' editado com sucesso.');
        } catch (\Exception $e) {
            return redirect(route('system.admin.perfis.index'))->withErrors(['Houve um erro ao editar o perfil de acesso.']);
        }
    }

    public function destroy($id)
    {
        if (strpos(Role::findOrFail(base64_decode($id))->name, 'Administrador') !== false or strpos(Role::findOrFail(base64_decode($id))->name, 'User') !== false) {
            return Redirect::back()->withErrors(['Houve um erro. Não é possível manipular informações relacionadas ao administrador ou user e nem atribuir novos perfis denominados como administradores ou usuários padrão no sistema.']);
        }
        try {
            // Excluindo
            $role = Role::findOrFail(base64_decode($id));
            $role->delete();
            return redirect(route('system.admin.perfis.index'))->with('success', 'Perfil de acesso excluído com sucesso.');
        } catch (\Exception $e) {
            return redirect(route('system.admin.perfis.index'))->with('mensagem', 'Houve um erro ao excluir o perfil de acesso.');
        }
    }
}
