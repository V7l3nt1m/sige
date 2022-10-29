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
        $usuario = auth()->user();
        if((strcasecmp($usuario->permissao, "Professor")) == 0 || (strcasecmp($usuario->permissao, "pcaadmin")) == 0){
            $query = DB::table('funcionarios')
            ->where('user_id', $usuario->id)
            ->get();
            foreach ($query as $funcionario) {
            return view('professor', ['usuario' => $usuario, 'funcionario' => $funcionario]);
        }
        }
        else{
            return redirect('acessdenied');
        }
        
}

public function update_professor(Request $request){
    $senha1 = $request->password1;
    $senha2 = $request->password2;

        $query2 = DB::table('users')
        ->join('funcionarios', 'users.id', 'funcionarios.user_id')
        ->where('funcionarios.id', $request->id)
        ->get();

        foreach ($query2 as $q2) {
            if(strcasecmp($senha1, $senha2) == 0 && ! Hash::check($senha1, $q2->senha_func)){
                $senha_func = Hash::make($senha1);
                Funcionario::where('id', $request->id)
                ->update(['senha_func' => $senha_func])
                ;
                User::where('id', $q2->user_id)
                ->update(['password' => $senha_func]);
                
                return redirect('/professor')->with('msg', 'Senha alterada com sucesso!'); 
            }
            elseif(strcasecmp($senha1, $senha2) != 0){
                return redirect('/professor')->with('msg', 'As senhas não coincidem');
            }elseif(Hash::check($senha1, $q2->senha_func)){
                return redirect('/professor')->with('msg', 'A senha já existe');
            } 
              
        }


   
}
}
