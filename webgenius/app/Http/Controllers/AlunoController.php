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



class AlunoController extends Controller
{
    public function index(Request $request){
            $user = \Auth::user();
            $query = DB::table('alunos')
            ->where('user_id', $user->id)
            ->get();

            $query2 = DB::table('alunos')
            ->select('nome_aluno')
            ->join('users', 'users.id', 'alunos.user_id')
            ->where('user_id', $user->id)
            ->get();
            foreach ($query as $aluno) {
                foreach ($query2 as $aluno2) {
                    $nome_aluno = $aluno2->nome_aluno;
                    $imagem_aluno = $aluno->imagem_aluno;
                    return view('aluno', ['user' => $user, 'aluno' => $aluno, 'nome_aluno' => $nome_aluno, 'imagem_aluno' => $imagem_aluno]);                }
               
            }
        }   


    public function perfil(Request $request){
        $user = \Auth::user();
        $rota = \Request::route()->getName();

        $query = DB::table('alunos')
        ->where('user_id', $user->id)
        ->get();

        $query2 = DB::table('alunos')
        ->select('nome_aluno')
        ->join('users', 'users.id', 'alunos.user_id')
        ->where('user_id', $user->id)
        ->get();
        foreach ($query as $aluno) {
            foreach ($query2 as $aluno2) {
                $imagem_aluno = $aluno->imagem_aluno;
                $outrosdados = DB::table('alunos')
                ->select('turmas.nome_turma', 'classes.nome_classe', 'cursos.nome_curso')
                ->join('turmas', 'turmas.id', 'alunos.turma_id')
                ->join('cursos', 'cursos.id', 'alunos.curso_id')
                ->join('classes', 'classes.id', 'alunos.classe_id')
                ->where('alunos.id', $aluno->id)
                ->get();
               
                foreach ($outrosdados as $dados) {
                    $nome_aluno = $aluno2->nome_aluno;
                    return view('ver_perfil', ['user' => $user, 'aluno' => $aluno, 'rota' => $rota, 'nome_aluno' => $nome_aluno, 'dados' => $dados, 'imagem_aluno' => $imagem_aluno]);                }
                }
              
           
        }
    }

    public function settings(){
        $user = \Auth::user();
        $rota = \Request::route()->getName();

        $query = DB::table('alunos')
        ->where('user_id', $user->id)
        ->get();

        $query2 = DB::table('alunos')
        ->select('nome_aluno')
        ->join('users', 'users.id', 'alunos.user_id')
        ->where('user_id', $user->id)
        ->get();
        foreach ($query as $aluno) {
            foreach ($query2 as $aluno2) {
                $imagem_aluno = $aluno->imagem_aluno;
                $nome_aluno = $aluno2->nome_aluno;
            
                return view('definições', ['user' => $user, 'aluno' => $aluno, 'rota' => $rota, 'nome_aluno' => $nome_aluno, 'imagem_aluno' => $imagem_aluno]);                

            }
        }
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
