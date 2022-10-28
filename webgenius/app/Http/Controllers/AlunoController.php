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
        $user = auth()->user();
        echo $user;
        return view('aluno');
    }

    public function login(){
        return view('/auth/login_aluno');
    }

    public function login_aluno(Request $request){
        $processo = $request->n_proceso;
        $senha = $request->password;

        $query = DB::table('alunos')
        ->where('num_processo', $processo)
        ->where('senha_aluno', $senha)
        ->get();

        if(count($query) == 0){
                return redirect('/login_aluno')->with('msg', 'Id ou Palavra-Passes estão incorrectos');
        }else{
            return redirect('aluno');
        }
    }

    public function update_senha(Request $request){
        $senha1 = $request->password1;
        $senha2 = $request->password2;

        if(strcasecmp($senha1, $senha2) == 0){
            $senha_aluno = Hash::make($senha1);
            Aluno::findOrFail($request->id)->update($request->all());

            return redirect('/aluno')->with('msg', 'Senha alterada com sucesso!');
        }else{
            return redirect('/aluno')->with('msg', 'As senhas não coincidem');
        }
        

       
    }
}
