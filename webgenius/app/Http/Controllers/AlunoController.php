<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Aluno;
use App\Models\User;


class AlunoController extends Controller
{
    public function index(){
        $usuario = auth()->user();
        if((strcasecmp($usuario->permissao, "aluno")) == 0 || (strcasecmp($usuario->permissao, "pcaadmin")) == 0){
            $user = \Auth::user();

            $query = DB::table('alunos')
            ->where('user_id', $user->id)
            ->get();
            foreach ($query as $aluno) {
                return view('aluno', ['user' => $user, 'aluno' => $aluno]);
            }
        }else{
            return redirect('acessdenied');        }

           
    }

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
                    
                    return redirect('/aluno')->with('msg', 'Senha alterada com sucesso!'); 
                }
                elseif(strcasecmp($senha1, $senha2) != 0){
                    return redirect('/aluno')->with('msg', 'As senhas não coincidem');
                }elseif(Hash::check($senha1, $q2->senha_aluno)){
                    return redirect('/aluno')->with('msg', 'A senha já existe');
                } 
                  
            }

    
       
    }
}
