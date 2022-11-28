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
class ProfPerfilController extends Controller
{
    public function perfil_professor(Request $request){
        $pagina_anterior = $request->headers->get('referer');
        $rota = \Request::route()->getName(); 
            $user = auth()->user();
            $funcionarios = DB::table('users')
            ->join('funcionarios', 'users.id', 'funcionarios.user_id')
            ->where('funcionarios.user_id', $user->id)
            ->get();
    
            foreach ($funcionarios as $funcionario){
                return view('Professor.ver_perfil_professor', ['user' => $user, 'funcionario' => $funcionario, 'pagina_anterior' => $pagina_anterior, 'rota' => $rota]);   
            }
    
            
              
        
    }
}
