<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome_curso',
    ];

    protected $guarded = [];

    public function alunos(){
        return $this->hasMany('App\Models\Aluno');
    }

    public function turmas(){
        return $this->belongsToMany('App\Models\Turma');
    }

    public function classes(){
        return $this->belongsToMany('App\Models\Classe');
    }
    public function disciplinas(){
        return $this->belongsToMany('App\Models\Disciplina');
    }
    public function funcionarios(){
        return $this->belongsToMany('App\Models\Funcionario');
}

public function classesFuncionariosTurmas(){
    return $this->BelongsToMany('App\Models\Classe', 'App\Models\Funcionario', 'App\Models\Turma');
}
}
