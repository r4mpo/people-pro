<?php

namespace App\Console\Commands\System\Admin;

use App\Models\User;
use Exception;
use Illuminate\Console\Command;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class ReproduzirSpatieNoBancoDeDados extends Command
{
    protected $signature = 'app:reproduzir-spatie-no-banco-de-dados';
    protected $description = 'Cadastra os papéis e suas permissões padrão no banco de dados da aplicação.';

    public function handle()
    {
        foreach (User::PERMISSIONS as $permission) {
            Permission::create($permission);
        }

        foreach (User::ROLES as $role) {
            $permissoes = Permission::where('rota', $role['name'])->pluck('name')->toArray();
            Role::create($role)->givePermissionTo($permissoes);
        }
    }
}
