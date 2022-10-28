<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Aluno;
use App\Models\Turma;
use App\Models\Disciplina;
use App\Models\Curso;
use App\Models\Classe;
use App\Models\Funcionario;
use Illuminate\Support\Facades\DB;

class EventController extends Controller
{
    public function index(){
        return view('webgenius');
        

    }

    public function register(){
        $turmas = Turma::all();
        $classes = Classe::all();
        $cursos = Curso::all();
        return view('/auth/register', ['turmas' => $turmas, 'classes' => $classes, 'cursos' => $cursos]);
    }

}
