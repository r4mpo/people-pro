<?php

namespace App\Models;

use App\Models\System\User\Beneficio;
use App\Models\System\User\Cargo;
use App\Models\System\User\Empresa;
use App\Models\System\User\Setor;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Notifications\NewResetPasswordNotification as ResetPassword;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

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
}