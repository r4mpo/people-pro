<?php

namespace App\Models\System\User;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cargo extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'descricao',
        'remuneracao',
        'user_id',
        'setor_id'
    ];

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function setor()
    {
        return $this->hasOne(Setor::class, 'id', 'setor_id');
    }

    public function formatar_remuneracao()
    {
        return 'R$ ' . number_format(($this->remuneracao / 100), 2, ',', '.');
    }

    public function colaboradores(){
        return $this->hasMany(Colaborador::class, 'cargo_id', 'id');
    }
}
