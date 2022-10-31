<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Funcionario extends Model
{
    protected $dates = ['date'];
    protected $guarded = [];
    protected $fillable = [
        'nome',
        'data_nasc',
        'email_fun',
        'telefone',
        'genero',
        'faltas',
        'folha_salario',
        'tipo_fun',
        'imagem_aluno',
    ];
    protected $hiden = [
        'senha_fun',
    ];

    public function user(){
        return $this->belongsTo('App\Models\User');
    }


public function turmas(){
    return $this->belongsToMany('App\Models\Turma');
}

public function cursos(){
    return $this->belongsToMany('App\Models\Curso');
}

public function classes(){
    return $this->belongsToMany('App\Models\Classe');
}
}
