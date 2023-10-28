<?php

namespace App\Models;

use App\Models\System\User\Beneficio;
use App\Models\System\User\Cargo;
use App\Models\System\User\Colaborador;
use App\Models\System\User\Empresa;
use App\Models\System\User\Financeiro;
use App\Models\System\User\Setor;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Notifications\NewResetPasswordNotification as ResetPassword;
use Spatie\Permission\Traits\HasRoles;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    const ROLE_PERMISSIONS_USER = 'User';
    const ROLE_PERMISSIONS_ADMIN = 'Administrador';

    const ROLES = [
        ['name' => SELF::ROLE_PERMISSIONS_ADMIN],
        ['name' => SELF::ROLE_PERMISSIONS_USER],
    ];

    # Array de permissões
    const PERMISSIONS = [
        ['name' => 'Visualizar informações da empresa', 'guard_name' => 'web', 'rota' => SELF::ROLE_PERMISSIONS_USER, 'menu' => 'Corporação', 'submenu' => 'Empresa'],
        ['name' => 'Atualizar informações da empresa', 'guard_name' => 'web', 'rota' => SELF::ROLE_PERMISSIONS_USER, 'menu' => 'Corporação', 'submenu' => 'Empresa'],

        ['name' => 'Visualizar benefícios', 'guard_name' => 'web', 'rota' => SELF::ROLE_PERMISSIONS_USER, 'menu' => 'Corporação', 'submenu' => 'Benefícios'],
        ['name' => 'Cadastrar benefícios', 'guard_name' => 'web', 'rota' => SELF::ROLE_PERMISSIONS_USER, 'menu' => 'Corporação', 'submenu' => 'Benefícios'],
        ['name' => 'Excluir benefícios', 'guard_name' => 'web', 'rota' => SELF::ROLE_PERMISSIONS_USER, 'menu' => 'Corporação', 'submenu' => 'Benefícios'],

        ['name' => 'Visualizar setores', 'guard_name' => 'web', 'rota' => SELF::ROLE_PERMISSIONS_USER, 'menu' => 'Cargos', 'submenu' => 'Setores'],
        ['name' => 'Editar setores', 'guard_name' => 'web', 'rota' => SELF::ROLE_PERMISSIONS_USER, 'menu' => 'Cargos', 'submenu' => 'Setores'],
        ['name' => 'Cadastrar setores', 'guard_name' => 'web', 'rota' => SELF::ROLE_PERMISSIONS_USER, 'menu' => 'Cargos', 'submenu' => 'Setores'],
        ['name' => 'Excluir setores', 'guard_name' => 'web', 'rota' => SELF::ROLE_PERMISSIONS_USER, 'menu' => 'Cargos', 'submenu' => 'Setores'],

        ['name' => 'Visualizar cargos', 'guard_name' => 'web', 'rota' => SELF::ROLE_PERMISSIONS_USER, 'menu' => 'Cargos', 'submenu' => 'Cargos'],
        ['name' => 'Editar cargos', 'guard_name' => 'web', 'rota' => SELF::ROLE_PERMISSIONS_USER, 'menu' => 'Cargos', 'submenu' => 'Cargos'],
        ['name' => 'Cadastrar cargos', 'guard_name' => 'web', 'rota' => SELF::ROLE_PERMISSIONS_USER, 'menu' => 'Cargos', 'submenu' => 'Cargos'],
        ['name' => 'Excluir cargos', 'guard_name' => 'web', 'rota' => SELF::ROLE_PERMISSIONS_USER, 'menu' => 'Cargos', 'submenu' => 'Cargos'],

        ['name' => 'Visualizar colaboradores', 'guard_name' => 'web', 'rota' => SELF::ROLE_PERMISSIONS_USER, 'menu' => 'Colaboradores', 'submenu' => 'Colaboradores'],
        ['name' => 'Editar colaboradores', 'guard_name' => 'web', 'rota' => SELF::ROLE_PERMISSIONS_USER, 'menu' => 'Colaboradores', 'submenu' => 'Colaboradores'],
        ['name' => 'Cadastrar colaboradores', 'guard_name' => 'web', 'rota' => SELF::ROLE_PERMISSIONS_USER, 'menu' => 'Colaboradores', 'submenu' => 'Colaboradores'],
        ['name' => 'Excluir colaboradores', 'guard_name' => 'web', 'rota' => SELF::ROLE_PERMISSIONS_USER, 'menu' => 'Colaboradores', 'submenu' => 'Colaboradores'],

        ['name' => 'Visualizar financeiros', 'guard_name' => 'web', 'rota' => SELF::ROLE_PERMISSIONS_USER, 'menu' => 'Colaboradores', 'submenu' => 'Financeiro'],
        ['name' => 'Visualizar documentos', 'guard_name' => 'web', 'rota' => SELF::ROLE_PERMISSIONS_USER, 'menu' => 'Colaboradores', 'submenu' => 'Financeiro'],
        ['name' => 'Editar financeiros', 'guard_name' => 'web', 'rota' => SELF::ROLE_PERMISSIONS_USER, 'menu' => 'Colaboradores', 'submenu' => 'Financeiro'],
        ['name' => 'Cadastrar financeiros', 'guard_name' => 'web', 'rota' => SELF::ROLE_PERMISSIONS_USER, 'menu' => 'Colaboradores', 'submenu' => 'Financeiro'],
        ['name' => 'Excluir financeiros', 'guard_name' => 'web', 'rota' => SELF::ROLE_PERMISSIONS_USER, 'menu' => 'Colaboradores', 'submenu' => 'Financeiro'],

        ['name' => 'Visualizar perfis de acesso', 'guard_name' => 'web', 'rota' => SELF::ROLE_PERMISSIONS_ADMIN, 'menu' => 'Controle', 'submenu' => 'Perfis de acesso'],
        ['name' => 'Editar perfis de acesso', 'guard_name' => 'web', 'rota' => SELF::ROLE_PERMISSIONS_ADMIN, 'menu' => 'Controle', 'submenu' => 'Perfis de acesso'],
        ['name' => 'Cadastrar perfis de acesso', 'guard_name' => 'web', 'rota' => SELF::ROLE_PERMISSIONS_ADMIN, 'menu' => 'Controle', 'submenu' => 'Perfis de acesso'],
        ['name' => 'Excluir perfis de acesso', 'guard_name' => 'web', 'rota' => SELF::ROLE_PERMISSIONS_ADMIN, 'menu' => 'Controle', 'submenu' => 'Perfis de acesso'],
        
        ['name' => 'Visualizar perfis e usuários', 'guard_name' => 'web', 'rota' => SELF::ROLE_PERMISSIONS_ADMIN, 'menu' => 'Controle', 'submenu' => 'Perfis e Usuários'],
        ['name' => 'Editar perfis e usuários', 'guard_name' => 'web', 'rota' => SELF::ROLE_PERMISSIONS_ADMIN, 'menu' => 'Controle', 'submenu' => 'Perfis e Usuários'],
    ];

    # Permissões
    const VISUALIZAR_INFORMACOES_EMPRESA = 'Visualizar informações da empresa';
    const ATUALIZAR_INFORMACOES_EMPRESA = 'Atualizar informações da empresa';
    const VISUALIZAR_BENEFICIOS = 'Visualizar benefícios';
    const CADASTRAR_BENEFICIOS = 'Cadastrar benefícios';
    const EXCLUIR_BENEFICIOS = 'Excluir benefícios';
    const VISUALIZAR_SETORES = 'Visualizar setores';
    const EDITAR_SETORES = 'Editar setores';
    const CADASTRAR_SETORES = 'Cadastrar setores';
    const EXCLUIR_SETORES = 'Excluir setores';
    const VISUALIZAR_CARGOS = 'Visualizar cargos';
    const EDITAR_CARGOS = 'Editar cargos';
    const CADASTRAR_CARGOS = 'Cadastrar cargos';
    const EXCLUIR_CARGOS = 'Excluir cargos';
    const VISUALIZAR_COLABORADORES = 'Visualizar colaboradores';
    const EDITAR_COLABORADORES = 'Editar colaboradores';
    const CADASTRAR_COLABORADORES = 'Cadastrar colaboradores';
    const EXCLUIR_COLABORADORES = 'Excluir colaboradores';
    const VISUALIZAR_FINANCEIROS = 'Visualizar financeiros';
    const VISUALIZAR_DOCUMENTOS = 'Visualizar documentos';
    const EDITAR_FINANCEIROS = 'Editar financeiros';
    const CADASTRAR_FINANCEIROS = 'Cadastrar financeiros';
    const EXCLUIR_FINANCEIROS = 'Excluir financeiros';
    const VISUALIZAR_PERFIS_ACESSO = 'Visualizar perfis de acesso';
    const EDITAR_PERFIS_ACESSO = 'Editar perfis de acesso';
    const CADASTRAR_PERFIS_ACESSO = 'Cadastrar perfis de acesso';
    const EXCLUIR_PERFIS_ACESSO = 'Excluir perfis de acesso';
    const VISUALIZAR_PERFIS_USUARIOS = 'Visualizar perfis e usuários';
    const EDITAR_PERFIS_USUARIOS = 'Editar perfis e usuários';

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPassword($token));
    }

    public static function beneficiosNaoAtribuidosAoUsuario($user_id)
    {
        return Beneficio::whereDoesntHave('usuariosQuePossuemEsteBeneficio', function ($query) use ($user_id) {
            $query->where('user_id', $user_id);
        })->get();
    }

    public function beneficio()
    {
        return $this->belongsToMany(Beneficio::class);
    }

    public function beneficios()
    {
        return $this->hasMany(Beneficio::class);
    }

    public function empresa()
    {
        return $this->hasOne(Empresa::class, 'user_id', 'id');
    }

    public function setores()
    {
        return $this->hasMany(Setor::class, 'user_id', 'id');
    }

    public function cargos()
    {
        return $this->hasMany(Cargo::class, 'user_id', 'id');
    }

    public function colaboradores()
    {
        return $this->hasMany(Colaborador::class, 'user_id', 'id');
    }

    public function financeiros()
    {
        return $this->hasMany(Financeiro::class, 'user_id', 'id');
    }
}
