<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Disciplina extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome_disc',
    ];

    protected $guarded = [];

    public function cursos(){
        return $this->belongsToMany('App\Models\Curso');
    }
    public function classes(){
        return $this->belongsToMany('App\Models\Classe');
    }

    public function funcionarios(){
        return $this->belongsToMany('App\Models\Funcionario');
    }

    public function cursosFuncionariosTurmas(){
        return $this->BelongsToMany('App\Models\Curso', 'App\Models\Funcionario', 'App\Models\Turma', 'App\Models\Disciplina');
    }

}
