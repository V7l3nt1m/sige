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

    public function cursos(){
        return $this->belongsToMany('App\Models\Curso');
    }
}

