<?php

namespace App\Http\Controllers\Tesouraria;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Aluno;
use App\Models\Turma;
use App\Models\Disciplina;
use App\Models\Curso;
use App\Models\Classe;
use App\Models\Funcionario;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class TesourariaController extends Controller
{
    public function index(){
            $user = auth()->user();
            $rota = \Request::route()->getName(); 
           return view('tesouraria', ['user' => $user, 'rota' => $rota]);
    }
    
        
}
