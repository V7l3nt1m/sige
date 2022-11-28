<?php

namespace App\Http\Controllers\Professor;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Aluno;
use App\Models\Turma;
use App\Models\Disciplina;
use App\Models\Curso;
use App\Models\Classe;
use App\Models\Nota;
use App\Models\Funcionario;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
class ProfDefController extends Controller
{
    
public function settings_professor(){
    $user = \Auth::user();
    $rota = \Request::route()->getName(); 
    $funcionarios = DB::table('users')
    ->join('funcionarios', 'users.id', 'funcionarios.user_id')
    ->where('funcionarios.user_id', $user->id)
    ->get();

    
    foreach ($funcionarios as $funcionario) {
        return view('Professor.defi_professor', ['user' => $user, 'funcionario' => $funcionario, 'rota' => $rota]);   
    }
}
}
