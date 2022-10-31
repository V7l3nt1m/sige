<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Turma extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome_turma',
    ];

    protected $guarded = [];

    public function alunos(){
        return $this->hasMany('App\Models\Aluno');
    }

    public function classes(){
            return $this->belongsToMany('App\Models\Classe');
    }
    public function cursos(){
        return $this->belongsToMany('App\Models\Curso');
}

public function funcionarios(){
        return $this->belongsToMany('App\Models\Funcionario');
}
}
