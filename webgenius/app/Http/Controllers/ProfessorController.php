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
                $imagem_fun = $funcionario->imagem_fun;
            return view('professor', ['user' => $user, 'funcionario' => $funcionario, 'imagem_fun' => $imagem_fun]);
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

        foreach ($funcionarios as $funcionario){
            return view('ver_perfil_professor', ['user' => $user, 'funcionario' => $funcionario]);   
        }

        
          
    
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
               
                
               User::where('id', $q2->user_id)
                ->update(['name' => $nome_user]);
                         
                User::where('id', $q2->user_id)
                         ->update(['password' => $senha]);

                 Funcionario::where('user_id', $request->id)
                ->update(['nome' => $nome_user]);

                 Funcionario::where('user_id', $request->id)
                ->update(['senha_func' => $senha]);

                
                                  
                
                return redirect('/professor/definições')->with('msg', 'Senha alterada com sucesso!'); 
            }
            elseif(strcasecmp($senha1, $senha2) != 0){
                return redirect('/professor/definições')->with('erro', 'As senhas não coincidem');
            }elseif(Hash::check($senha1, $q2->senha_func)){
                return redirect('/professor/definições')->with('erro', 'A senha já existe');
            }
            
        }

   
}

public function minhas_turmas(){
    $user = auth()->user();
    
    

    $query = DB::table('funcionarios')
    ->select('turmas.nome_turma')
    ->join('funcionario_turma', 'funcionarios.id', '=', 'funcionario_turma.funcionario_id')
    ->join('turmas', 'turmas.id', 'funcionario_turma.turma_id')
    ->where('funcionarios.user_id', $user->id)
    ->get();

    $query2 = DB::table('funcionarios')
    ->select('cursos.nome_curso')
    ->join('curso_funcionario', 'funcionarios.id', '=', 'curso_funcionario.funcionario_id')
    ->join('cursos', 'cursos.id', 'curso_funcionario.curso_id')
    ->where('funcionarios.user_id', $user->id)
    ->get();

    $query3 = DB::table('funcionarios')
    ->select('classes.nome_classe')
    ->join('classe_funcionario', 'funcionarios.id', '=', 'classe_funcionario.funcionario_id')
    ->join('classes', 'classes.id', 'classe_funcionario.classe_id')
    ->where('funcionarios.user_id', $user->id)
    ->get();

    $funcionarios = DB::table('users')
    ->join('funcionarios', 'users.id', 'funcionarios.user_id')
    ->where('funcionarios.user_id', $user->id)
    ->get();

    foreach ($funcionarios as $funcionario) {
            
                $imagem_fun = $funcionario->imagem_fun;
                return view('minhas_turmas', ['user'=> $user, 'query' => $query, 'query2' => $query2,'query3' => $query3, 'imagem_fun' => $imagem_fun]);
            
        
    }
    

   


}
}
