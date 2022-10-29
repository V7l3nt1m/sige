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

    public function index_register(){
        return redirect('/');
    }

    public function acessdenied(){
        return view('acessdenied');
    }


}
