<?php

namespace App\Http\Controllers\Professor;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Aluno;
use App\Models\Turma;
use App\Models\Disciplina;
use App\Models\Curso;
use App\Models\Classe;
use App\Models\Nota;
use App\Models\Funcionario;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ProfessorController extends Controller
{
    public function index(){
        $user = auth()->user();
        $rota = \Request::route()->getName(); 
        if((strcasecmp($user->permissao, "Professor")) == 0 || (strcasecmp($user->permissao, "pcaadmin")) == 0){
            $query = DB::table('funcionarios')
            ->where('user_id', $user->id)
            ->get();
            foreach ($query as $funcionario) {
                $imagem_fun = $funcionario->imagem_fun;
            return view('Professor.professor', ['user' => $user, 'funcionario' => $funcionario, 'imagem_fun' => $imagem_fun, 'rota' => $rota]);
        }
        }
        else{
            return redirect('acessdenied');
        }
        
}






public function minhas_turmas(){
    $user = auth()->user(); 
    $rota = \Request::route()->getName(); 
    $query = DB::table('funcionarios')
    ->select('turmas.id as turmaid','turmas.nome_turma','classes.id as classeid', 'classes.nome_classe','cursos.id as cursoid', 'cursos.nome_curso')
    ->join('classe_curso_disciplina_funcionario_turma', 'funcionarios.id', '=', 'classe_curso_disciplina_funcionario_turma.funcionario_id')
    ->join('turmas', 'turmas.id', 'classe_curso_disciplina_funcionario_turma.turma_id')
    ->join('classes', 'classes.id', 'classe_curso_disciplina_funcionario_turma.classe_id')
    ->join('cursos', 'cursos.id', 'classe_curso_disciplina_funcionario_turma.curso_id')
    ->where('funcionarios.user_id', $user->id)
    ->get();

    $funcionarios = DB::table('users')
    ->join('funcionarios', 'users.id', 'funcionarios.user_id')
    ->where('funcionarios.user_id', $user->id)
    ->get();
    $id = Funcionario::where('user_id', $user->id)->select('id')->get();

     
    foreach ($query as $dados) {
        $query4 = DB::table('alunos')
        ->where('curso_id', $dados->cursoid)
        ->where('classe_id', $dados->classeid)
        ->where('turma_id', $dados->turmaid)
        ->orderBy('alunos.nome_aluno', 'asc')
        ->get();


    }

                     foreach ($funcionarios as $funcionario) {
                        $imagem_fun = $funcionario->imagem_fun;
            return view('Professor.minhas_turmas', ['user'=> $user, 'query' => $query, 'imagem_fun' => $imagem_fun, 'query4' => $query4, 'rota' => $rota]);
        }


}

public function timestreI(){
    $user = auth()->user(); 
    $rota = \Request::route()->getName(); 
    $query = DB::table('funcionarios')
    ->select('turmas.id as turmaid','turmas.nome_turma','classes.id as classeid', 'classes.nome_classe','cursos.id as cursoid', 'cursos.nome_curso')
    ->join('classe_curso_disciplina_funcionario_turma', 'funcionarios.id', '=', 'classe_curso_disciplina_funcionario_turma.funcionario_id')
    ->join('turmas', 'turmas.id', 'classe_curso_disciplina_funcionario_turma.turma_id')
    ->join('classes', 'classes.id', 'classe_curso_disciplina_funcionario_turma.classe_id')
    ->join('cursos', 'cursos.id', 'classe_curso_disciplina_funcionario_turma.curso_id')
    ->where('funcionarios.user_id', $user->id)
    ->get();

    $query2 = DB::table('funcionarios')
    ->select('turmas.id as turmaid','turmas.nome_turma','classes.id as classeid', 'classes.nome_classe','cursos.id as cursoid', 'cursos.nome_curso')
    ->join('classe_curso_disciplina_funcionario_turma', 'funcionarios.id', '=', 'classe_curso_disciplina_funcionario_turma.funcionario_id')
    ->join('turmas', 'turmas.id', 'classe_curso_disciplina_funcionario_turma.turma_id')
    ->join('classes', 'classes.id', 'classe_curso_disciplina_funcionario_turma.classe_id')
    ->join('cursos', 'cursos.id', 'classe_curso_disciplina_funcionario_turma.curso_id')
    ->where('funcionarios.user_id', $user->id)
    ->get();
    

    $funcionarios = DB::table('users')
    ->join('funcionarios', 'users.id', 'funcionarios.user_id')
    ->where('funcionarios.user_id', $user->id)
    ->get();
    

    $id = Funcionario::where('user_id', $user->id)->select('id')->first();

    $query_disciplinas2 = DB::table('disciplinas')
    ->select('disciplinas.nome_disc')
    ->join('classe_curso_disciplina_funcionario_turma', 'disciplinas.id', 'classe_curso_disciplina_funcionario_turma.disciplina_id')
    ->join('funcionarios', 'funcionarios.id', 'classe_curso_disciplina_funcionario_turma.funcionario_id')
    ->where('funcionarios.user_id', $user->id)
    ->first();
    
        $query4 = DB::table('funcionarios')
        ->select('alunos.id', 'alunos.nome_aluno', 'alunos.num_processo', 'alunos.data_nasc', 'alunos.telefone_aluno', 'alunos.genero', 'alunos.email_aluno', 'turmas.nome_turma', 'cursos.nome_curso', 'classes.nome_classe', 'n.t1_p1', 'n.t1_p2', 'n.t1_mac', 'n.t1_mdf')
        ->join('classe_curso_disciplina_funcionario_turma', 'funcionarios.id', 'classe_curso_disciplina_funcionario_turma.funcionario_id')
        ->join('alunos', 'alunos.curso_id', 'classe_curso_disciplina_funcionario_turma.curso_id')
        ->join('turmas', 'turmas.id', 'alunos.turma_id')
        ->join('cursos', 'cursos.id', 'alunos.curso_id')
        ->join('classes', 'classes.id', 'alunos.classe_id')
        ->join('notas as n', 'n.aluno_id', 'alunos.id')
        ->where('classe_curso_disciplina_funcionario_turma.funcionario_id', $id->id)
        ->where('n.disciplina', $query_disciplinas2->nome_disc)
        ->orderBy('alunos.nome_aluno', 'asc')
        ->get();

        


    $query_disciplinas = DB::table('disciplinas')
    ->select('disciplinas.nome_disc')
    ->join('classe_curso_disciplina_funcionario_turma', 'disciplinas.id', 'classe_curso_disciplina_funcionario_turma.disciplina_id')
    ->join('funcionarios', 'funcionarios.id', 'classe_curso_disciplina_funcionario_turma.funcionario_id')
    ->where('funcionarios.user_id', $user->id)
    ->get();


                     foreach ($funcionarios as $funcionario) {
                        $imagem_fun = $funcionario->imagem_fun;
            return view('Professor.trimestre_I', ['user'=> $user, 'query' => $query, 'imagem_fun' => $imagem_fun, 'query4' => $query4, 'query_disciplinas' => $query_disciplinas]);
        }

}

public function timestreIi(){
    $user = auth()->user(); 
    $rota = \Request::route()->getName(); 
    $query = DB::table('funcionarios')
    ->select('turmas.nome_turma', 'classes.nome_classe', 'cursos.nome_curso')
    ->join('classe_curso_disciplina_funcionario_turma', 'funcionarios.id', '=', 'classe_curso_disciplina_funcionario_turma.funcionario_id')
    ->join('turmas', 'turmas.id', 'classe_curso_disciplina_funcionario_turma.turma_id')
    ->join('classes', 'classes.id', 'classe_curso_disciplina_funcionario_turma.classe_id')
    ->join('cursos', 'cursos.id', 'classe_curso_disciplina_funcionario_turma.curso_id')
    ->where('funcionarios.user_id', $user->id)
    ->get();
    

    $funcionarios = DB::table('users')
    ->join('funcionarios', 'users.id', 'funcionarios.user_id')
    ->where('funcionarios.user_id', $user->id)
    ->get();
    
    $id = Funcionario::where('user_id', $user->id)->select('id')->get();

    $query_disciplinas2 = DB::table('disciplinas')
    ->select('disciplinas.nome_disc')
    ->join('classe_curso_disciplina_funcionario_turma', 'disciplinas.id', 'classe_curso_disciplina_funcionario_turma.disciplina_id')
    ->join('funcionarios', 'funcionarios.id', 'classe_curso_disciplina_funcionario_turma.funcionario_id')
    ->where('funcionarios.user_id', $user->id)
    ->first();

    foreach ($id as $id_fun) {
        $query4 = DB::table('funcionarios')
        ->select('alunos.id', 'alunos.nome_aluno', 'alunos.num_processo', 'alunos.data_nasc', 'alunos.telefone_aluno', 'alunos.genero', 'alunos.email_aluno', 'turmas.nome_turma', 'cursos.nome_curso', 'classes.nome_classe','notas.t1_p1','notas.t1_p2', 'notas.t1_mac', 'notas.t1_mdf', 'notas.t2_p1', 'notas.t2_p2', 'notas.t2_mac', 'notas.t2_mdf', 'notas.t3_p1', 'notas.t3_pf', 'notas.t3_mac', 'notas.t3_mdf')
        ->join('classe_curso_disciplina_funcionario_turma', 'funcionarios.id', 'classe_curso_disciplina_funcionario_turma.funcionario_id')
        ->join('alunos', 'alunos.curso_id', 'classe_curso_disciplina_funcionario_turma.curso_id')
        ->join('turmas', 'turmas.id', 'alunos.turma_id')
        ->join('cursos', 'cursos.id', 'alunos.curso_id')
        ->join('classes', 'classes.id', 'alunos.classe_id')
        ->join('notas', 'notas.aluno_id', 'alunos.id')
        ->where('classe_curso_disciplina_funcionario_turma.funcionario_id', $id_fun->id)
        ->where('notas.disciplina', $query_disciplinas2->nome_disc)
        ->orderBy('alunos.nome_aluno', 'asc')
        ->get();
    }
    $query_disciplinas = DB::table('disciplinas')
    ->select('disciplinas.nome_disc')
    ->join('classe_curso_disciplina_funcionario_turma', 'disciplinas.id', 'classe_curso_disciplina_funcionario_turma.disciplina_id')
    ->join('funcionarios', 'funcionarios.id', 'classe_curso_disciplina_funcionario_turma.funcionario_id')
    ->where('funcionarios.user_id', $user->id)
    ->get();
    


                     foreach ($funcionarios as $funcionario) {
                        $imagem_fun = $funcionario->imagem_fun;
            return view('Professor.trimestre_II', ['user'=> $user, 'query' => $query, 'imagem_fun' => $imagem_fun, 'query4' => $query4, 'query_disciplinas' => $query_disciplinas, 'rota' => $rota]);
        }

}

public function timestreIII(){
    $user = auth()->user(); 
    $rota = \Request::route()->getName(); 
    $query = DB::table('funcionarios')
    ->select('turmas.nome_turma', 'classes.nome_classe', 'cursos.nome_curso')
    ->join('classe_curso_disciplina_funcionario_turma', 'funcionarios.id', '=', 'classe_curso_disciplina_funcionario_turma.funcionario_id')
    ->join('turmas', 'turmas.id', 'classe_curso_disciplina_funcionario_turma.turma_id')
    ->join('classes', 'classes.id', 'classe_curso_disciplina_funcionario_turma.classe_id')
    ->join('cursos', 'cursos.id', 'classe_curso_disciplina_funcionario_turma.curso_id')
    ->where('funcionarios.user_id', $user->id)
    ->get();
    

    $funcionarios = DB::table('users')
    ->join('funcionarios', 'users.id', 'funcionarios.user_id')
    ->where('funcionarios.user_id', $user->id)
    ->get();
    
    $id = Funcionario::where('user_id', $user->id)->select('id')->get();

    $query_disciplinas2 = DB::table('disciplinas')
    ->select('disciplinas.nome_disc')
    ->join('classe_curso_disciplina_funcionario_turma', 'disciplinas.id', 'classe_curso_disciplina_funcionario_turma.disciplina_id')
    ->join('funcionarios', 'funcionarios.id', 'classe_curso_disciplina_funcionario_turma.funcionario_id')
    ->where('funcionarios.user_id', $user->id)
    ->first();

    foreach ($id as $id_fun) {
        
        $query4 = DB::table('funcionarios')
        ->select('alunos.id', 'alunos.nome_aluno', 'alunos.num_processo', 'alunos.data_nasc', 'alunos.telefone_aluno', 'alunos.genero', 'alunos.email_aluno', 'turmas.nome_turma', 'cursos.nome_curso', 'classes.nome_classe','notas.t1_p1','notas.t1_p2', 'notas.t1_mac', 'notas.t1_mdf', 'notas.t2_p1', 'notas.t2_p2', 'notas.t2_mac', 'notas.t2_mdf', 'notas.t3_p1', 'notas.t3_pf', 'notas.t3_mac', 'notas.t3_mdf')
        ->join('classe_curso_disciplina_funcionario_turma', 'funcionarios.id', 'classe_curso_disciplina_funcionario_turma.funcionario_id')
        ->join('alunos', 'alunos.curso_id', 'classe_curso_disciplina_funcionario_turma.curso_id')
        ->join('turmas', 'turmas.id', 'alunos.turma_id')
        ->join('cursos', 'cursos.id', 'alunos.curso_id')
        ->join('classes', 'classes.id', 'alunos.classe_id')
        ->join('notas', 'notas.aluno_id', 'alunos.id')
        ->where('classe_curso_disciplina_funcionario_turma.funcionario_id', $id_fun->id)
        ->where('notas.disciplina', $query_disciplinas2->nome_disc)
        ->orderBy('alunos.nome_aluno', 'asc')
        ->get();



    }
    $query_disciplinas = DB::table('disciplinas')
    ->select('disciplinas.nome_disc')
    ->join('classe_curso_disciplina_funcionario_turma', 'disciplinas.id', 'classe_curso_disciplina_funcionario_turma.disciplina_id')
    ->join('funcionarios', 'funcionarios.id', 'classe_curso_disciplina_funcionario_turma.funcionario_id')
    ->where('funcionarios.user_id', $user->id)
    ->get();


                     foreach ($funcionarios as $funcionario) {
                        $imagem_fun = $funcionario->imagem_fun;
            return view('Professor.trimestre_III', ['user'=> $user, 'query' => $query, 'imagem_fun' => $imagem_fun, 'query4' => $query4, 'query_disciplinas' => $query_disciplinas, 'rota' => $rota]);
        }

}

public function recurso(){
    $user = auth()->user(); 
    $rota = \Request::route()->getName(); 
    $query = DB::table('funcionarios')
    ->select('turmas.nome_turma', 'classes.nome_classe', 'cursos.nome_curso')
    ->join('classe_curso_disciplina_funcionario_turma', 'funcionarios.id', '=', 'classe_curso_disciplina_funcionario_turma.funcionario_id')
    ->join('turmas', 'turmas.id', 'classe_curso_disciplina_funcionario_turma.turma_id')
    ->join('classes', 'classes.id', 'classe_curso_disciplina_funcionario_turma.classe_id')
    ->join('cursos', 'cursos.id', 'classe_curso_disciplina_funcionario_turma.curso_id')
    ->where('funcionarios.user_id', $user->id)
    ->get();
    

    $funcionarios = DB::table('users')
    ->join('funcionarios', 'users.id', 'funcionarios.user_id')
    ->where('funcionarios.user_id', $user->id)
    ->get();
    
    $id = Funcionario::where('user_id', $user->id)->select('id')->get();

    $query_disciplinas2 = DB::table('disciplinas')
    ->select('disciplinas.nome_disc')
    ->join('classe_curso_disciplina_funcionario_turma', 'disciplinas.id', 'classe_curso_disciplina_funcionario_turma.disciplina_id')
    ->join('funcionarios', 'funcionarios.id', 'classe_curso_disciplina_funcionario_turma.funcionario_id')
    ->where('funcionarios.user_id', $user->id)
    ->first();


    foreach ($id as $id_fun) {
        $query4 = DB::table('funcionarios')
        ->select('alunos.id', 'alunos.nome_aluno', 'alunos.num_processo', 'alunos.data_nasc', 'alunos.telefone_aluno', 'alunos.genero', 'alunos.email_aluno', 'turmas.nome_turma', 'cursos.nome_curso', 'classes.nome_classe','notas.t1_p1','notas.t1_p2', 'notas.t1_mac', 'notas.t1_mdf', 'notas.t2_p1', 'notas.t2_p2', 'notas.t2_mac', 'notas.t2_mdf', 'notas.t3_p1', 'notas.t3_pf', 'notas.t3_mac', 'notas.t3_mdf', 'notas.recurso')
        ->join('classe_curso_disciplina_funcionario_turma', 'funcionarios.id', 'classe_curso_disciplina_funcionario_turma.funcionario_id')
        ->join('alunos', 'alunos.curso_id', 'classe_curso_disciplina_funcionario_turma.curso_id')
        ->join('turmas', 'turmas.id', 'alunos.turma_id')
        ->join('cursos', 'cursos.id', 'alunos.curso_id')
        ->join('classes', 'classes.id', 'alunos.classe_id')
        ->join('notas', 'notas.aluno_id', 'alunos.id')
        ->where('classe_curso_disciplina_funcionario_turma.funcionario_id', $id_fun->id)
        ->where('notas.disciplina', $query_disciplinas2->nome_disc)
        ->orderBy('alunos.nome_aluno', 'asc')
        ->get();



    }
    $query_disciplinas = DB::table('disciplinas')
    ->select('disciplinas.nome_disc')
    ->join('classe_curso_disciplina_funcionario_turma', 'disciplinas.id', 'classe_curso_disciplina_funcionario_turma.disciplina_id')
    ->join('funcionarios', 'funcionarios.id', 'classe_curso_disciplina_funcionario_turma.funcionario_id')
    ->where('funcionarios.user_id', $user->id)
    ->get();


                     foreach ($funcionarios as $funcionario) {
                        $imagem_fun = $funcionario->imagem_fun;
            return view('Professor.recurso', ['user'=> $user, 'query' => $query, 'imagem_fun' => $imagem_fun, 'query4' => $query4, 'query_disciplinas' => $query_disciplinas, 'rota' => $rota]);
        }

}


}
