<?php

namespace App\Http\Controllers\Aluno;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Aluno;
use App\Models\Turma;
use App\Models\Disciplina;
use App\Models\Nota;
use App\Models\Curso;
use App\Models\Classe;
use App\Models\Funcionario;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AlunoUpdateController extends Controller
{
    public function update_senha(Request $request){
        $senha1 = $request->password1;
        $senha2 = $request->password2;

            $query2 = DB::table('users')
            ->join('alunos', 'users.id', 'alunos.user_id')
            ->where('alunos.id', $request->id)
            ->get();

            foreach ($query2 as $q2) {
                if(strcasecmp($senha1, $senha2) == 0 && ! Hash::check($senha1, $q2->senha_aluno)){
                    $senha_aluno = Hash::make($senha1);
                    Aluno::where('id', $request->id)
                    ->update(['senha_aluno' => $senha_aluno])
                    ;
                    User::where('id', $q2->user_id)
                    ->update(['password' => $senha_aluno]);
                    
                    return redirect('/alunos/definições')->with('msg', 'Senha alterada com sucesso!'); 
                }
                elseif(strcasecmp($senha1, $senha2) != 0){
                    return redirect('/alunos/definições')->with('erro', 'As senhas não coincidem');
                }elseif(Hash::check($senha1, $q2->senha_aluno)){
                    return redirect('/alunos/definições')->with('erro', 'A senha já existe');
                } 
                  
            }

    
       
    }
}
