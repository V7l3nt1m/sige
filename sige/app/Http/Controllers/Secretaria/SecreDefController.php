<?php

namespace App\Http\Controllers\Secretaria;

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

class SecreDefController extends Controller
{
    public function defi_admin(){
        $user = \Auth::user();
        $rota = \Request::route()->getName(); 
        $funcionarios = DB::table('users')
        ->join('funcionarios', 'users.id', 'funcionarios.user_id')
        ->where('funcionarios.user_id', $user->id)
        ->get();
    
        
        foreach ($funcionarios as $funcionario) {
            return view('defi_admin', ['user' => $user, 'funcionario' => $funcionario, 'rota' => $rota]);   
        }
                             
        }
}
