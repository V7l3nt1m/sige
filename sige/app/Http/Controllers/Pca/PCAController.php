<?php

namespace App\Http\Controllers\Pca;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Aluno;
use App\Models\Nota;
use App\Models\Turma;
use App\Models\Disciplina;
use App\Models\Curso;
use App\Models\Classe;
use App\Models\Funcionario;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;




class PCAController extends Controller
{
    public function index(){
        $user = auth()->user();
        $logo_escola = DB::table('escolas')
        ->select('logo_escola')
        ->where('nome_escola', $user->nome_escola)->first();
    
        $usuario = auth()->user();
        if((strcasecmp($usuario->permissao, "pcaadmin")) == 0){
            $rota = \Request::route()->getName(); 
            $query = DB::table('funcionarios')
            ->join('users', 'users.id', 'funcionarios.user_id')
            ->where('funcionarios.user_id', $user->id)
            ->get();
           foreach ($query as $funcionario) {
            $imagem_fun = $funcionario->imagem_fun;
            return view('PCA_admin', ['user' => $user, 'rota' => $rota, 'imagem_fun' => $imagem_fun, 'logo_escola' => $logo_escola]);
            
           }
           return view('PCA_admin', ['user' => $user, 'rota' => $rota, 'logo_escola' => $logo_escola]);
        }else{
            return redirect('acessdenied');
                }
       
    }
    

//Cadastro de alunos
    public function cadasaluno(){
        $usuario = auth()->user();
        if((strcasecmp($usuario->permissao, "pcaadmin")) == 0){
        $turmas = Turma::all();
        $classes = Classe::all();
        $cursos = Curso::all();
        $rota = \Request::route()->getName();
        $search2 = request('search2');
        $user = auth()->user();
        $logo_escola = DB::table('escolas')
        ->select('logo_escola')
        ->where('nome_escola', $user->nome_escola)->first();

        if($search2){

            $alunos = Aluno::where([
                ['nome_aluno', 'like', '%'.$search2.'%']
            ])->get();
        }else{
            $alunos = Aluno::all();
        }
        $query = DB::table('funcionarios')
            ->join('users', 'users.id', 'funcionarios.user_id')
            ->where('funcionarios.user_id', $user->id)
            ->get();
           foreach ($query as $funcionario) {
            $imagem_fun = $funcionario->imagem_fun;
        return view('Cadastro.cadasaluno', ['imagem_fun' => $imagem_fun , 'user' => $user, 'alunos' => $alunos, 'search2' => $search2,'rota' => $rota, 'turmas' => $turmas, 'classes' => $classes, 'cursos' => $cursos, 'logo_escola' => $logo_escola]);
           }
           return view('Cadastro.cadasaluno', ['user' => $user, 'alunos' => $alunos, 'search2' => $search2,'rota' => $rota, 'turmas' => $turmas, 'classes' => $classes, 'cursos' => $cursos, 'logo_escola' => $logo_escola]);
    }else{
        return redirect('acessdenied');
        }
}
//termina cadastro de alunos

    
    public function cadafuncionario(){
        
        $rota = \Request::route()->getName();
        $turmas = Turma::all();
        $cursos = Curso::all();
        $classes = Classe::all();
        $disciplinas = Disciplina::all();

        $user = auth()->user();
        $logo_escola = DB::table('escolas')
        ->select('logo_escola')
        ->where('nome_escola', $user->nome_escola)->first();

        $query = DB::table('funcionarios')
        ->join('users', 'users.id', 'funcionarios.user_id')
        ->where('funcionarios.user_id', $user->id)
        ->get();
       foreach ($query as $funcionario) {
        $imagem_fun = $funcionario->imagem_fun;
            return view('Cadastro.cadafuncionario', ['imagem_fun' => $imagem_fun,'user' => $user, 'rota' => $rota, 'turmas' => $turmas, 'disciplinas' => $disciplinas, 'cursos' => $cursos, 'classes' => $classes, 'logo_escola' => $logo_escola]);

       }
       return view('Cadastro.cadafuncionario', ['user' => $user, 'rota' => $rota, 'turmas' => $turmas, 'disciplinas' => $disciplinas, 'cursos' => $cursos, 'classes' => $classes, 'logo_escola' => $logo_escola]);

    }

    
    public function permissoes(){
        $user = auth()->user();
        $rota = \Request::route()->getName();
        $search = request('search');
        $logo_escola = DB::table('escolas')
        ->select('logo_escola')
        ->where('nome_escola', $user->nome_escola)->first();

        if($search){

            $funcionarios = Funcionario::where([
                ['nome', 'like', '%'.$search.'%']

            ])->get();
        

        }else{
                $funcionarios = Funcionario::all();
        }
        $allfunc = Funcionario::all();
        $query = DB::table('funcionarios')
        ->join('users', 'users.id', 'funcionarios.user_id')
        ->where('funcionarios.user_id', $user->id)
        ->get();
       foreach ($query as $funcionario) {
        $imagem_fun = $funcionario->imagem_fun;
        return view('PCA.permissoes', ['imagem_fun' => $imagem_fun,'search' => $search, 'funcionarios' => $funcionarios, 'allfunc' => $allfunc, 'user' => $user, 'rota' => $rota, 'logo_escola' => $logo_escola ]);
    }  
    return view('PCA.permissoes', ['search' => $search, 'funcionarios' => $funcionarios, 'allfunc' => $allfunc, 'user' => $user, 'rota' => $rota, 'logo_escola' => $logo_escola ]);

}

    //cadastro de turmas ver
    public function turmas(){
        $rota = \Request::route()->getName();
        $cursos = Curso::all();
        $classes = Classe::all();
        $user = auth()->user();
        $logo_escola = DB::table('escolas')
        ->select('logo_escola')
        ->where('nome_escola', $user->nome_escola)->first();
        $query = DB::table('funcionarios')
        ->join('users', 'users.id', 'funcionarios.user_id')
        ->where('funcionarios.user_id', $user->id)
        ->get();
       foreach ($query as $funcionario) {
        $imagem_fun = $funcionario->imagem_fun;
        return view('Cadastro.cadaturma', ['imagem_fun' => $imagem_fun,'user' => $user, 'rota' => $rota, 'cursos' => $cursos, 'classes' => $classes, 'logo_escola' => $logo_escola]);
    }
    return view('Cadastro.cadaturma', ['user' => $user, 'rota' => $rota, 'cursos' => $cursos, 'classes' => $classes, 'logo_escola' => $logo_escola]);

}
  
    

    //Cadastro de disciplinas
    public function disciplinas(){
        $rota = \Request::route()->getName();
        $classes = Classe::All();
        $cursos = Curso::All();
        $user = auth()->user();
        $logo_escola = DB::table('escolas')
        ->select('logo_escola')
        ->where('nome_escola', $user->nome_escola)->first();
        $query = DB::table('funcionarios')
        ->join('users', 'users.id', 'funcionarios.user_id')
        ->where('funcionarios.user_id', $user->id)
        ->get();
       foreach ($query as $funcionario) {
        $imagem_fun = $funcionario->imagem_fun;
        return view('Cadastro.disciplinas', ['imagem_fun' => $imagem_fun,'user' => $user, 'rota' => $rota, 'cursos' => $cursos, 'classes' => $classes, 'logo_escola' => $logo_escola]);
    }
    return view('Cadastro.disciplinas', ['user' => $user, 'rota' => $rota, 'cursos' => $cursos, 'classes' => $classes, 'logo_escola' => $logo_escola ]);
}

  
    //Cadastro de cursos
    public function cursos(){
        $rota = \Request::route()->getName();
        $user = auth()->user();
        $logo_escola = DB::table('escolas')
        ->select('logo_escola')
        ->where('nome_escola', $user->nome_escola)->first();
        $query = DB::table('funcionarios')
        ->join('users', 'users.id', 'funcionarios.user_id')
        ->where('funcionarios.user_id', $user->id)
        ->get();
       foreach ($query as $funcionario) {
        $imagem_fun = $funcionario->imagem_fun;
        return view('Cadastro.cursos', ['imagem_fun' => $imagem_fun,'user' => $user, 'rota' => $rota, 'logo_escola' => $logo_escola ]);
       }
       return view('Cadastro.cursos', ['user' => $user, 'rota' => $rota, 'logo_escola' => $logo_escola ]);
    }

   




    

    public function classes(){
        $rota = \Request::route()->getName();
        $user = auth()->user();
        $logo_escola = DB::table('escolas')
        ->select('logo_escola')
        ->where('nome_escola', $user->nome_escola)->first();
        $query = DB::table('funcionarios')
        ->join('users', 'users.id', 'funcionarios.user_id')
        ->where('funcionarios.user_id', $user->id)
        ->get();
       foreach ($query as $funcionario) {
        $imagem_fun = $funcionario->imagem_fun;
        return view('Cadastro.classes', ['imagem_fun' => $imagem_fun,'user' => $user, 'rota' => $rota, 'logo_escola' => $logo_escola ]);
    }
    return view('Cadastro.classes', ['user' => $user, 'rota' => $rota, 'logo_escola' => $logo_escola ]);

}

   

    public function gerenciaralunos(){
        $turmas = Turma::all();
        $cursos = Curso::all();
        $classes = classe::all();
        $alunos2 = Aluno::all();

        $user = auth()->user();
        $logo_escola = DB::table('escolas')
        ->select('logo_escola')
        ->where('nome_escola', $user->nome_escola)->first();
        
        $rota = \Request::route()->getName();
        $search = request('search');
        if($search){

            $alunos = DB::table('alunos')
            ->select('alunos.id', 'alunos.num_processo', 'alunos.nome_aluno', 'alunos.data_nasc', 'alunos.email_aluno', 'alunos.telefone_aluno', 'alunos.genero'
            , 'turmas.nome_turma', 'cursos.nome_curso', 'classes.nome_classe'
            )
            ->join('turmas', 'turmas.id', 'alunos.turma_id')
            ->join('cursos', 'cursos.id', 'alunos.curso_id')
            ->join('classes', 'classes.id', 'alunos.classe_id')
            ->where('nome_aluno', 'like', '%'.$search.'%')
            ->where('alunos.nome_escola', $user->nome_escola)
            ->orWhere('num_processo', 'like', '%'.$search.'%')
            ->orWhere('turmas.nome_turma', 'like', '%'.$search.'%')
            ->orWhere('classes.nome_classe', 'like', '%'.$search.'%')
            ->orWhere('cursos.nome_curso', 'like', '%'.$search.'%')
            ->get();


        }else{
            $alunos = Aluno::where('nome_escola', $user->nome_escola)->get();
        }
       if(request('classe') && request('turma') && request('curso')){
        $classe_busca = request('classe');
        $turma_busca = request('turma');
        $curso_busca = request('curso');

            $query1 = DB::table('alunos')
            ->whereIn('classe_id', function ($query2){
                    $query2->select('id')
                    ->from('classes')
                    ->where('nome_classe', request('classe'))
                    ;
            })
            ->whereIn('curso_id', function ($query2){
                $query2->select('id')
                ->from('cursos')
                ->where('nome_curso', request('curso'))
                ;
            })
            ->whereIn('turma_id', function ($query2){
                $query2->select('id')
                ->from('turmas')
                ->where('nome_turma', request('turma'))
                ;
        })
        ->orderBy('nome_aluno')
            ->get();
            
            $query = DB::table('funcionarios')
            ->join('users', 'users.id', 'funcionarios.user_id')
            ->where('funcionarios.user_id', $user->id)
            ->get();
           foreach ($query as $funcionario) {
            $imagem_fun = $funcionario->imagem_fun;
            return view('PCA.gerenciaralunos', ['user' => $user, 'rota' => $rota, 'alunos' => $alunos, 'search' => $search, 'turmas' => $turmas, 'cursos' => $cursos,'classes' => $classes,
            'query1' => $query1,'imagem_fun' => $imagem_fun, 'classe_busca' => $classe_busca, 'turma_busca' => $turma_busca, 'curso_busca' => $curso_busca, 'alunos2' => $alunos2
        , 'logo_escola' => $logo_escola]);
           }
           return view('PCA.gerenciaralunos', ['user' => $user, 'rota' => $rota, 'alunos' => $alunos, 'search' => $search, 'turmas' => $turmas, 'cursos' => $cursos,'classes' => $classes,
            'query1' => $query1,'classe_busca' => $classe_busca, 'turma_busca' => $turma_busca, 'curso_busca' => $curso_busca, 'alunos2' => $alunos2, 'logo_escola' => $logo_escola
        ]);
        }
           else{
                $query1 = "";
                $query = DB::table('funcionarios')
        ->join('users', 'users.id', 'funcionarios.user_id')
        ->where('funcionarios.user_id', $user->id)
        ->get();
       foreach ($query as $funcionario) {
        $imagem_fun = $funcionario->imagem_fun;
            return view('PCA.gerenciaralunos', ['imagem_fun' => $imagem_fun,'user' => $user, 'rota' => $rota, 'alunos' => $alunos, 'search' => $search, 'turmas' => $turmas, 'cursos' => $cursos,'classes' => $classes, 'query1' => $query1 , 'alunos2' => $alunos2
        , 'logo_escola' => $logo_escola]);
           }
           return view('PCA.gerenciaralunos', ['user' => $user, 'rota' => $rota, 'alunos' => $alunos, 'search' => $search, 'turmas' => $turmas, 'cursos' => $cursos,'classes' => $classes, 'query1' => $query1 , 'alunos2' => $alunos2
        , 'logo_escola' => $logo_escola]);
        }
       
    }

    public function gerenciarturmas(){
        $turmas = Turma::all();
        $classes = Classe::all();
        $cursos = Curso::all();
        $rota = \Request::route()->getName();

        $query = DB::table('turmas')
       ->select('classes.nome_classe', 'cursos.nome_curso', 'turmas.nome_turma')
       ->join('classe_turma', 'classe_turma.turma_id', 'turmas.id')
       ->join('classes', 'classes.id', 'classe_turma.classe_id')

       ->join('classe_curso', 'classes.id', 'classe_curso.classe_id')
       ->join('cursos', 'cursos.id', 'classe_curso.curso_id')      
        ->get();
            $rota = \Request::route()->getName(); 
        
        $user = auth()->user();
        $logo_escola = DB::table('escolas')
        ->select('logo_escola')
        ->where('nome_escola', $user->nome_escola)->first();
        $query2 = DB::table('funcionarios')
        ->join('users', 'users.id', 'funcionarios.user_id')
        ->where('funcionarios.user_id', $user->id)
        ->get();
       foreach ($query2 as $funcionario) {
        $imagem_fun = $funcionario->imagem_fun;
        return view('PCA.gerenturmas', ['imagem_fun' => $imagem_fun,'user' => $user, 'rota' => $rota,'turmas' => $turmas, 'classes' => $classes, 'cursos' => $cursos, 'query' => $query, 'logo_escola' => $logo_escola, 'rota' => $rota]);
    }
    return view('PCA.gerenturmas', ['user' => $user, 'rota' => $rota,'turmas' => $turmas, 'classes' => $classes, 'cursos' => $cursos, 'query' => $query, 'logo_escola' => $logo_escola, 'rota' => $rota]);

}

   
//gerenciar funcionarios
        public function gerenciarfuncio(){
        $user = auth()->user();
        $logo_escola = DB::table('escolas')
        ->select('logo_escola')
        ->where('nome_escola', $user->nome_escola)->first();
        $rota = \Request::route()->getName();

        $search = request('search');
        if($search){

            $funcionarios = DB::table('funcionarios')
            ->where('nome', 'like', '%'.$search.'%')
            ->where('nome_escola', $user->nome_escola)
            ->orWhere('tipo_fun', 'like', '%'.$search.'%')
            ->where('nome_escola', $user->nome_escola)
            ->get();
        }else{
            $funcionarios = Funcionario::where('nome_escola', $user->nome_escola)->get();
        }
        $query = DB::table('funcionarios')
        ->join('users', 'users.id', 'funcionarios.user_id')
        ->where('funcionarios.user_id', $user->id)
        ->where('funcionarios.nome_escola', $user->nome_escola)
        ->get();
       foreach ($query as $funcionario) {
        $imagem_fun = $funcionario->imagem_fun;
        return view('PCA.g_func', ['logo_escola' => $logo_escola,'imagem_fun' => $imagem_fun, 'user' => $user, 'rota' => $rota,
         'funcionarios' => $funcionarios, 'search' => $search]);
          
       }
       return view('PCA.g_func', ['logo_escola' => $logo_escola,'user' => $user, 'rota' => $rota,
         'funcionarios' => $funcionarios, 'search' => $search]);
        }
       
         //edit alunos
         
    public function edit_alunos($id){
        $user = auth()->user();
        $logo_escola = DB::table('escolas')
        ->select('logo_escola')
        ->where('nome_escola', $user->nome_escola)->first();
        $rota = \Request::route()->getName();
       $aluno = Aluno::findOrFail($id);
       
       $turmas = Turma::all();
       $classes = Classe::all();
       $cursos = Curso::all();

       $query1 = DB::table('turmas')
       ->join('alunos', 'turmas.id', 'alunos.turma_id')
       ->where('alunos.id', $aluno->id)
       ->get();

       $query2 = DB::table('classes')
       ->join('alunos', 'classes.id', 'alunos.classe_id')
       ->where('alunos.id', $aluno->id)
       ->get();

       $query3 = DB::table('cursos')
       ->join('alunos', 'cursos.id', 'alunos.curso_id')
       ->where('alunos.id', $aluno->id)
       ->get();

       foreach ($query1 as $turma_nome) {
        foreach ($query2 as $classe_nome) {
            foreach ($query3 as $curso_nome) {
                $nome_turma = $turma_nome->nome_turma;
                $nome_classe = $classe_nome->nome_classe;
                $nome_curso = $curso_nome->nome_curso;

                $query = DB::table('funcionarios')
        ->join('users', 'users.id', 'funcionarios.user_id')
        ->where('funcionarios.user_id', $user->id)
        ->get();
       foreach ($query as $funcionario) {
        $imagem_fun = $funcionario->imagem_fun;
                return view('edit.edit_aluno', ['logo_escola' => $logo_escola,'imagem_fun' => $imagem_fun, 'nome_turma' => $nome_turma,'nome_classe' => $nome_classe, 'nome_curso' => $nome_curso,  'user' => $user, 'aluno' => $aluno, 'turmas' => $turmas, 'classes' => $classes, 'cursos' => $cursos, 'rota' => $rota]);
            }
            return view('edit.edit_aluno', ['logo_escola' => $logo_escola,'nome_turma' => $nome_turma,'nome_classe' => $nome_classe, 'nome_curso' => $nome_curso,  'user' => $user, 'aluno' => $aluno, 'turmas' => $turmas, 'classes' => $classes, 'cursos' => $cursos, 'rota' => $rota]);

        }
        }
       }
        
    }

//adicionarturma
public function adicionarturma($id){
    $user = auth()->user();
    $logo_escola = DB::table('escolas')
    ->select('logo_escola')
    ->where('nome_escola', $user->nome_escola)->first();
    $rota = \Request::route()->getName();
    $disciplinas = Disciplina::all();

    $turmas = Turma::all();
       $classes = Classe::all();
       $cursos = Curso::all();

       $funcionario = Funcionario::findOrFail($id);

       $query = DB::table('funcionarios')
       ->join('users', 'users.id', 'funcionarios.user_id')
       ->where('funcionarios.user_id', $user->id)
       ->get();
       
      foreach ($query as $funcionarios) {
       $imagem_fun = $funcionarios->imagem_fun;
                return view('adicionar.adicionar_turma', ['logo_escola' => $logo_escola,'imagem_fun' => $imagem_fun,  'user' => $user, 'turmas' => $turmas, 'classes' => $classes, 'cursos' => $cursos, 'rota' => $rota, 'funcionario' => $funcionario, 'disciplinas' => $disciplinas]);
            
      }
      return view('adicionar.adicionar_turma', ['logo_escola' => $logo_escola,'user' => $user, 'turmas' => $turmas, 'classes' => $classes, 'cursos' => $cursos, 'rota' => $rota, 'funcionario' => $funcionario, 'disciplinas' => $disciplinas]);

}

public function edit_func($id){
    $user = auth()->user();
    $logo_escola = DB::table('escolas')
    ->select('logo_escola')
    ->where('nome_escola', $user->nome_escola)->first();
        $rota = \Request::route()->getName();
         
       $turmas = Turma::all();
       $classes = Classe::all();
       $cursos = Curso::all();
       $disciplinas = Disciplina::all();
       
       $funcionario = Funcionario::findOrFail($id);

       if (strcasecmp($funcionario->tipo_fun, "professor") == 0) {

       $query = DB::table('funcionarios')
       ->select('classe_curso_disciplina_funcionario_turma.id','classes.nome_classe', 'cursos.nome_curso', 'turmas.nome_turma')
       ->join('classe_curso_disciplina_funcionario_turma', 'funcionarios.id', 'classe_curso_disciplina_funcionario_turma.funcionario_id')
       ->join('classes', 'classes.id', 'classe_curso_disciplina_funcionario_turma.classe_id')
       ->join('turmas', 'turmas.id', 'classe_curso_disciplina_funcionario_turma.turma_id')
       ->join('cursos', 'cursos.id', 'classe_curso_disciplina_funcionario_turma.curso_id')
       ->where('funcionarios.id', $id)
       ->get();


       $query4 = DB::table('funcionarios')
       ->join('disciplina_funcionario', 'funcionarios.id', 'disciplina_funcionario.funcionario_id')
       ->join('disciplinas', 'disciplinas.id', 'disciplina_funcionario.disciplina_id')
       ->where('funcionarios.id', $id)
       ->get();
       

                foreach ($query4 as $disciplina) {
                    $nome_disciplina = $disciplina->nome_disc;
                    $query10 = DB::table('funcionarios')
        ->join('users', 'users.id', 'funcionarios.user_id')
        ->where('funcionarios.user_id', $user->id)
        ->get();
       foreach ($query10 as $funcionarios) {
        $imagem_fun = $funcionarios->imagem_fun;
                }
                return view('edit.edit_func', ['logo_escola' => $logo_escola,'imagem_fun' => $imagem_fun, 'user' => $user, 'query' => $query, 'nome_disciplina' => $nome_disciplina,  'funcionario' => $funcionario, 'rota' => $rota, 'turmas' => $turmas, 'classes' => $classes, 'cursos' => $cursos, 'disciplinas' => $disciplinas]);

            }
            return view('edit.edit_func', ['logo_escola' => $logo_escola,'user' => $user, 'query' => $query, 'nome_disciplina' => $nome_disciplina,  'funcionario' => $funcionario, 'rota' => $rota, 'turmas' => $turmas, 'classes' => $classes, 'cursos' => $cursos, 'disciplinas' => $disciplinas]);

        }else{
            
                $query10 = DB::table('funcionarios')
    ->join('users', 'users.id', 'funcionarios.user_id')
    ->where('funcionarios.user_id', $user->id)
    ->get();
   foreach ($query10 as $funcionarios) {
    $imagem_fun = $funcionarios->imagem_fun;
            }
            return view('edit.edit_func', ['logo_escola' => $logo_escola,'imagem_fun' => $imagem_fun, 'user' => $user, 'funcionario' => $funcionario, 'rota' => $rota, 'turmas' => $turmas, 'classes' => $classes, 'cursos' => $cursos, 'disciplinas' => $disciplinas]);


        }
        return view('edit.edit_func', ['logo_escola' => $logo_escola,'user' => $user, 'funcionario' => $funcionario, 'rota' => $rota, 'turmas' => $turmas, 'classes' => $classes, 'cursos' => $cursos, 'disciplinas' => $disciplinas]);

        
}



public function edit_turm_func($id){
    $user = auth()->user();
    $logo_escola = DB::table('escolas')
    ->select('logo_escola')
    ->where('nome_escola', $user->nome_escola)->first();
    $rota = \Request::route()->getName();

    $turmas = Turma::all();
       $classes = Classe::all();
       $cursos = Curso::all();

       $dados = DB::table('classe_curso_disciplina_funcionario_turma')
       ->select('classe_curso_disciplina_funcionario_turma.id', 'classes.nome_classe', 'turmas.nome_turma', 'cursos.nome_curso')
       ->join('turmas', 'turmas.id', 'classe_curso_disciplina_funcionario_turma.turma_id')
       ->join('cursos', 'cursos.id', 'classe_curso_disciplina_funcionario_turma.curso_id')
       ->join('classes', 'classes.id', 'classe_curso_disciplina_funcionario_turma.classe_id')
       ->where('classe_curso_disciplina_funcionario_turma.id', $id)
       ->get();
       
       $funcionarios = DB::table('funcionarios')
       ->join('classe_curso_disciplina_funcionario_turma', 'funcionarios.id', 'classe_curso_disciplina_funcionario_turma.funcionario_id')
       ->where('classe_curso_disciplina_funcionario_turma.id', $id)
       ->get();

       foreach ($dados as $dado) {
        $id = $dado->id;
        $nome_turma = $dado->nome_turma;
        $nome_curso = $dado->nome_curso;
        $nome_classe = $dado->nome_classe;

       foreach ($funcionarios as $funcionario) {
        $query = DB::table('funcionarios')
        ->join('users', 'users.id', 'funcionarios.user_id')
        ->where('funcionarios.user_id', $user->id)
        ->get();
       foreach ($query as $funcionario) {
        $imagem_fun = $funcionario->imagem_fun;
        return view('edit.edit_turma_func',  ['logo_escola' => $logo_escola,'imagem_fun' => $imagem_fun, 'user' => $user, 'turmas' => $turmas, 'classes' => $classes, 'cursos' => $cursos, 'rota' => $rota, 'funcionario' => $funcionario, 'nome_turma' => $nome_turma
    , 'nome_curso' => $nome_curso, 'nome_classe' => $nome_classe, 'id' => $id]);
       }
       return view('edit.edit_turma_func',  ['logo_escola' => $logo_escola,'user' => $user, 'turmas' => $turmas, 'classes' => $classes, 'cursos' => $cursos, 'rota' => $rota, 'funcionario' => $funcionario, 'nome_turma' => $nome_turma
    , 'nome_curso' => $nome_curso, 'nome_classe' => $nome_classe, 'id' => $id]);
    }
    }
}
}



