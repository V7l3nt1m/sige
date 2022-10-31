<?php

namespace App\Http\Controllers;
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
           return view('tesouraria', ['user' => $user]);
    }
    public function defi_admin(){
        $user = \Auth::user();
    
        $funcionarios = DB::table('users')
        ->join('funcionarios', 'users.id', 'funcionarios.user_id')
        ->where('funcionarios.user_id', $user->id)
        ->get();
    
        
        foreach ($funcionarios as $funcionario) {
            return view('defi_admin2', ['user' => $user, 'funcionario' => $funcionario]);   
        }
                             
        }
        public function perfil4(Request $request){
            $user = \Auth::user();
    
            $funcionarios = DB::table('users')
            ->join('funcionarios', 'users.id', 'funcionarios.user_id')
            ->where('funcionarios.user_id', $user->id)
            ->get();
    
                return view('ver_perfil4', ['user' => $user, 'funcionarios' => $funcionarios]);   
    
            
              
        }
}
