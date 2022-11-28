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
class TestPerfilController extends Controller
{
    public function perfil4(Request $request){
        $pagina_anterior = $request->headers->get('referer');
        $user = \Auth::user();
        $rota = \Request::route()->getName(); 
        $funcionarios = DB::table('users')
        ->join('funcionarios', 'users.id', 'funcionarios.user_id')
        ->where('funcionarios.user_id', $user->id)
        ->get();

            return view('ver_perfil4', ['user' => $user, 'funcionarios' => $funcionarios, 'pagina_anterior' => $pagina_anterior, 'rota' => $rota]);   

        
          
    }
}
