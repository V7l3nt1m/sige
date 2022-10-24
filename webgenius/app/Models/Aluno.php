<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aluno extends Model
{
    
    protected $fillable = [
        'nome_aluno',
        'data_nasc',
        'email_aluno',
        'telefone_aluno',
        'genero',
        'nota_aluno',
        'num_faltas',
        'estado_aprovado',
        'propina',
        'imagem_aluno',
    ];
    protected $hiden = [
        'senha_aluno',
    ];

    protected $dates = ['date'];
    protected $guarded = [];
}
