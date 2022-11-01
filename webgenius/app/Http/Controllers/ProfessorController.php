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

class ProfessorController extends Controller
{
    public function index(){
        $user = auth()->user();
        if((strcasecmp($user->permissao, "Professor")) == 0 || (strcasecmp($user->permissao, "pcaadmin")) == 0){
            $query = DB::table('funcionarios')
            ->where('user_id', $user->id)
            ->get();
            foreach ($query as $funcionario) {
            return view('professor', ['user' => $user, 'funcionario' => $funcionario]);
        }
        }
        else{
            return redirect('acessdenied');
        }
        
}

public function perfil_professor(){
        $user = \Auth::user();
        $funcionarios = DB::table('users')
        ->join('funcionarios', 'users.id', 'funcionarios.user_id')
        ->where('funcionarios.user_id', $user->id)
        ->get();

            return view('ver_perfil_professor', ['user' => $user, 'funcionarios' => $funcionarios]);   

        
          
    
}

public function settings_professor(){
    $user = \Auth::user();

    $funcionarios = DB::table('users')
    ->join('funcionarios', 'users.id', 'funcionarios.user_id')
    ->where('funcionarios.user_id', $user->id)
    ->get();

    
    foreach ($funcionarios as $funcionario) {
        return view('defi_professor', ['user' => $user, 'funcionario' => $funcionario]);   
    }
}

public function update_professor(Request $request){
    $senha1 = $request->password1;
    $senha2 = $request->password2;
    $user = auth()->user();
    $nome_user = $request->nome_user;

        $query2 = DB::table('users')
        ->join('funcionarios', 'users.id', 'funcionarios.user_id')
        ->where('funcionarios.user_id', $request->id)
        ->get();
       

       foreach ($query2 as $q2) {
            if(strcasecmp($senha1, $senha2) == 0 && ! Hash::check($senha1, $q2->senha_func)){
                $senha = Hash::make($senha1);
                Funcionario::where('user_id', $request->id)
                ->update(['senha_func' => $senha],
                ['nome' => $nome_user])
                ;
                User::where('id', $q2->user_id)
                ->update(['password' => $senha],
            ['name', $nome_user]);
                
                return redirect('/professor/definições')->with('msg', 'Senha alterada com sucesso!'); 
            }
            elseif(strcasecmp($senha1, $senha2) != 0){
                return redirect('/professor/definições')->with('msg', 'As senhas não coincidem');
            }elseif(Hash::check($senha1, $q2->senha_func)){
                return redirect('/professor/definições')->with('msg', 'A senha já existe');
            } 
              
        }

   
}
}
