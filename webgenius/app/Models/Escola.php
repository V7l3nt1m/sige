<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Escola extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected $fillable = [
        'nome_escolas',
        'n_registro',
        'contrato',
        'pacote',
        'n_bi',
        'email',
        'valor_p_aluno',
        'telefone',
        'cidade',
        'Municipio/Bairro/Escola',
        'logo_escola'
    ];
}
