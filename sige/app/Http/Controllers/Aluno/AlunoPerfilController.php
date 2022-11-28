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

class AlunoPerfilController extends Controller
{
    public function perfil(Request $request){
        $pagina_anterior = $request->headers->get('referer');
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
                    return view('alunos.ver_perfil', ['user' => $user, 'aluno' => $aluno, 'rota' => $rota, 'nome_aluno' => $nome_aluno, 'dados' => $dados, 'imagem_aluno' => $imagem_aluno, 'pagina_anterior' => $pagina_anterior]);                }
                }
              
           
        }
    }
}
