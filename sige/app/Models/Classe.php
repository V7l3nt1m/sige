<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classe extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome_classe',
    ];

    protected $guarded = [];

    public function alunos(){
        return $this->hasMany('App\Models\Aluno');
    }

    public function turmas(){
        return $this->belongsToMany('App\Models\Turma');
    }
    public function disciplinas(){
        return $this->belongsToMany('App\Models\Disciplina');
    }

    public function cursos(){
        return $this->belongsToMany('App\Models\Curso');
    }

    public function funcionarios(){
        return $this->belongsToMany('App\Models\Funcionario');
}

public function cursosFuncionariosTurmas(){
    return $this->BelongsToMany('App\Models\Curso', 'App\Models\Funcionario', 'App\Models\Turma');
}
}

