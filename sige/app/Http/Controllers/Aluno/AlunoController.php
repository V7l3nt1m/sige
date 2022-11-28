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



class AlunoController extends Controller
{
    public function index(Request $request){
            $user = \Auth::user();
            $query = DB::table('alunos')
            ->where('user_id', $user->id)
            ->get();
            $rota = \Request::route()->getName(); 
            $query2 = DB::table('alunos')
            ->select('nome_aluno')
            ->join('users', 'users.id', 'alunos.user_id')
            ->where('user_id', $user->id)
            ->get();
            foreach ($query as $aluno) {
                foreach ($query2 as $aluno2) {
                    $nome_aluno = $aluno2->nome_aluno;
                    $imagem_aluno = $aluno->imagem_aluno;
                    return view('alunos.aluno', ['user' => $user, 'aluno' => $aluno, 'nome_aluno' => $nome_aluno, 'imagem_aluno' => $imagem_aluno, 'rota' => $rota]);         
                       }
               
            }
        }   

    public function timestreI(){
        $user = \Auth::user();
        $rota = \Request::route()->getName();

        $notas = DB::table('notas')
        ->join('alunos', 'notas.aluno_id', 'alunos.id')
        ->where('alunos.user_id', $user->id)
        ->get();

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
            
                return view('alunos.trimestre1', ['user' => $user, 'aluno' => $aluno, 'rota' => $rota, 'nome_aluno' => $nome_aluno, 'imagem_aluno' => $imagem_aluno, 'notas' => $notas]);                

            }
        }
    }

    public function timestreII(){
        $user = \Auth::user();
        $rota = \Request::route()->getName();

        $notas = DB::table('notas')
        ->join('alunos', 'notas.aluno_id', 'alunos.id')
        ->where('alunos.user_id', $user->id)
        ->get();

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
            
                return view('alunos.trimestre2', ['user' => $user, 'aluno' => $aluno, 'rota' => $rota, 'nome_aluno' => $nome_aluno, 'imagem_aluno' => $imagem_aluno, 'notas' => $notas]);                

            }
        }

        
    }
    public function timestreIII(){
        $user = \Auth::user();
        $rota = \Request::route()->getName();

        $notas = DB::table('notas')
        ->join('alunos', 'notas.aluno_id', 'alunos.id')
        ->where('alunos.user_id', $user->id)
        ->get();

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
            
                return view('alunos.trimestre3', ['user' => $user, 'aluno' => $aluno, 'rota' => $rota, 'nome_aluno' => $nome_aluno, 'imagem_aluno' => $imagem_aluno, 'notas' => $notas]);                

            }
        }
}

public function recurso(){
    $user = \Auth::user();
    $rota = \Request::route()->getName();

    $notas = DB::table('notas')
    ->join('alunos', 'notas.aluno_id', 'alunos.id')
    ->where('alunos.user_id', $user->id)
    ->get();

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
        
            return view('alunos.recurso', ['user' => $user, 'aluno' => $aluno, 'rota' => $rota, 'nome_aluno' => $nome_aluno, 'imagem_aluno' => $imagem_aluno, 'notas' => $notas]);                

        }
    }
}
}