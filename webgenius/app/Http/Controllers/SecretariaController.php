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
use Illuminate\Support\Facades\Hash;


class SecretariaController extends Controller
{
    public function index(){
        $user = auth()->user();
        return view('secretaria', ['user' => $user]);
}


public function defi_admin(){
    $user = \Auth::user();

    $funcionarios = DB::table('users')
    ->join('funcionarios', 'users.id', 'funcionarios.user_id')
    ->where('funcionarios.user_id', $user->id)
    ->get();

    
    foreach ($funcionarios as $funcionario) {
        return view('defi_admin', ['user' => $user, 'funcionario' => $funcionario]);   
    }
                         
    }
    public function perfil3(){
        $user = \Auth::user();

        $funcionarios = DB::table('users')
        ->join('funcionarios', 'users.id', 'funcionarios.user_id')
        ->where('funcionarios.user_id', $user->id)
        ->get();

            return view('ver_perfil3', ['user' => $user, 'funcionarios' => $funcionarios]);   

        
          
    }

}