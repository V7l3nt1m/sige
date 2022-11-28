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
class SecrePerfilController extends Controller
{
    public function perfil3(Request $request){
        $pagina_anterior = $request->headers->get('referer');
        $user = \Auth::user();
        $rota = \Request::route()->getName(); 
        $funcionarios = DB::table('users')
        ->join('funcionarios', 'users.id', 'funcionarios.user_id')
        ->where('funcionarios.user_id', $user->id)
        ->get();

            return view('ver_perfil3', ['user' => $user, 'funcionarios' => $funcionarios, 'pagina_anterior' => $pagina_anterior, 'rota' => $rota]);   

          
    }
}
