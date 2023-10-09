<?php

namespace App\Models\System\User;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Financeiro extends Model
{
    use HasFactory;

    protected $fillable = [
        "descricao",
        "documento",
        "user_id",
    ];

    public function user()
    {
        return $this->hasOne(User::class, "id", "user_id");
    }
}