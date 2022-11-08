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

}
