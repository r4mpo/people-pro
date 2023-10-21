<?php

namespace App\Models\System\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Setor extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'descricao',
        'user_id',
    ];

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function cargos(){
        return $this->hasMany(Cargo::class, 'setor_id', 'id');
    }
}