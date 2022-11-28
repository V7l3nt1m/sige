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

class AlunoDefController extends Controller
{
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
            
                return view('alunos.definições', ['user' => $user, 'aluno' => $aluno, 'rota' => $rota, 'nome_aluno' => $nome_aluno, 'imagem_aluno' => $imagem_aluno]);                

            }
        }
    }

}
