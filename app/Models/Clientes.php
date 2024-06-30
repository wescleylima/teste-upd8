<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clientes extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'nome',
        'cpf',
        'data_nascimento',
        'sexo',
        'endereco',
        'estado',
        'cidade',
    ];
}
