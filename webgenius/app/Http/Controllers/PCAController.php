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



class PCAController extends Controller
{
    public function index(){
        $usuario = auth()->user();
        if((strcasecmp($usuario->permissao, "pcaadmin")) == 0){
            $rota = \Request::route()->getName();
            $user = auth()->user();
    
          return view('PCA_admin', ['user' => $user, 'rota' => $rota]);
        }else{
            return redirect('acessdenied');
                }
       
    }
    


    public function cadasaluno(){
        $usuario = auth()->user();
        if((strcasecmp($usuario->permissao, "pcaadmin")) == 0){
        $turmas = Turma::all();
        $classes = Classe::all();
        $cursos = Curso::all();
        $rota = \Request::route()->getName();
        $search2 = request('search2');

        if($search2){

            $alunos = Aluno::where([
                ['nome_aluno', 'like', '%'.$search2.'%']
            ])->get();
        }else{
            $alunos = Aluno::all();
        }
        $user = auth()->user();
        return view('cadasaluno', ['user' => $user, 'alunos' => $alunos, 'search2' => $search2,'rota' => $rota, 'turmas' => $turmas, 'classes' => $classes, 'cursos' => $cursos]);
    }else{
        return redirect('acessdenied');
        }
}


    public function store_alunos(Request $req){
        $aluno1 = new Aluno;
        $aluno1->nome_aluno = $req->nome_aluno;
        $aluno1->num_processo = $req->n_processo;
        $aluno1->telefone_aluno = $req->telefone;
        $aluno1->email_aluno = $req->email;
        $aluno1->genero = $req->genero_aluno;

        $user = new User;

        $user->name = $req->n_processo;
        $user->email = $req->email;
        $user->permissao = "Aluno";
        $user->password = Hash::make("Aluno2022");


            //image upload
            if($req->hasfile('image') && $req->file('image')->isValid()){

                $requestImage = $req->image;

                $extension = $requestImage->extension();

                $imageName = md5($requestImage->getClientOriginalName() . strtotime("now")) . "." . $extension;

                $requestImage->move(public_path('img/alunos'), $imageName);

                $aluno1->imagem_aluno = $imageName;
        
               $aluno1->data_nasc = $req->data_nasc;
               
               
                if(strtotime($req->data_nasc) > strtotime(date('d-m-Y'))){
                        echo ("A data de nascimento e maior que a data de hj");
                        return redirect('/pcaadmin/cadasaluno');
                }else{
                    $query1 = DB::table('turmas')
                    ->select('id')
                    ->where('nome_turma', $req->nome_turma)
                    ->get();

                    $query2 = DB::table('cursos')
                    ->select('id')
                    ->where('nome_curso', $req->nome_curso)
                    ->get();

                    $query3 = DB::table('classes')
                    ->select('id')
                    ->where('nome_classe', $req->nome_classe)
                    ->get();


                    foreach ($query1 as $q) {   
                        foreach ($query2 as $q2) {   
                            foreach ($query3 as $q3) {   
                                $aluno1->turma_id = $q->id;
                                $aluno1->curso_id = $q2->id;
                                $aluno1->classe_id = $q3->id;   
                                
                                $query8 = DB::table('alunos')
                                ->select('id')
                                ->orderBy('id', 'desc')
                                ->limit(1)
                                ->get();

                                $query9 = DB::table('users')
                                ->select('id')
                                ->orderBy('id', 'desc')
                                ->limit(1)
                                ->get();
                                
                                
                                if(count($query8) == 0 && count($query9) > 0){
                                    foreach ($query9 as $q9) {
                                        $aluno1->id = 1;
                                        $user->id = $q9->id + 1;
                                        $aluno1->user_id = $user->id;
                                            $user->save();
                                            $aluno1->save();
                                            return redirect('/pcaadmin');
                                    }    
                                }
                                else{
                                    foreach ($query9 as $q9) {
                                        foreach ($query8 as $q8) {
                                            $aluno1->id = $q8->id + 1;
                                            $user->id = $q9->id + 1;
                                            $aluno1->user_id = $user->id;
    
                                            $user->save();
                                            $aluno1->save();
                                            return redirect('/pcaadmin');
                                              }
                                    }
                                   
                                }
                                  
                               
                            }
                        }
                    }
                   
                }

           
            }  


    }

    public function cadafuncionario(){
        $rota = \Request::route()->getName();
        $user = auth()->user();
        return view('cadafuncionario', ['user' => $user, 'rota' => $rota]);
    }

    public function store_funcionarios(Request $req){
        $funcio = new Funcionario;
        $funcio->nome = $req->nome_func;
        $funcio->tipo_fun = $req->funcao;
        $funcio->telefone = $req->telefone;
        $funcio->email_fun = $req->email;
        $funcio->genero = $req->genero_func;

        $user = new User;
        $user->name = $req->nome_func;
        $user->email = $req->email;
        $user->permissao = $req->funcao;
        $user->password = Hash::make("funcionario_2022");
            $funcio->senha_func = "funcionario_2022";

           

            //image upload
            if($req->hasfile('image') && $req->file('image')->isValid()){

                $requestImage = $req->image;

                $extension = $requestImage->extension();

                $imageName = md5($requestImage->getClientOriginalName() . strtotime("now")) . "." . $extension;

                $requestImage->move(public_path('img/funcionarios'), $imageName);

                $funcio->imagem_fun = $imageName;

                $funcio->data_nasc = $req->data_nasc;

                $query = DB::table('users')
                ->select('id')
                ->orderBy('id', 'desc')
                ->limit(1)
                ->get();

                foreach ($query as $q) {
                $funcio->user_id = $q->id + 1;
                
                $user->save();    
                $funcio->save();
                return redirect('/pcaadmin');
                }

            }

        
    }


    public function permissoes(){
        $rota = \Request::route()->getName();
        $search = request('search');

        if($search){

            $funcionarios = Funcionario::where([
                ['nome', 'like', '%'.$search.'%']

            ])->get();
        

        }else{
                $funcionarios = Funcionario::all();
        }
        $allfunc = Funcionario::all();
        $user = auth()->user();
        return view('permissoes', ['search' => $search, 'funcionarios' => $funcionarios, 'allfunc' => $allfunc, 'user' => $user, 'rota' => $rota ]);
    }  

public function update_permissao(Request $request){
    $query = DB::table('users')
    ->join('funcionarios', 'users.id', 'funcionarios.user_id')
    ->where('funcionarios.id', $request->id)
    ->get();


  foreach ($query as $q) {
    User::where('id', $q->user_id)
        ->update(['permissao' => $request->permissao]);

        Funcionario::where('id', $request->id)
        ->update(['tipo_fun' => $request->permissao]);
        
       return redirect('/pcaadmin/permissoes');
    }

  


}

    //cadastro de turmas
    public function turmas(){
        $rota = \Request::route()->getName();

        $user = auth()->user();
        return view('cadaturma', ['user' => $user, 'rota' => $rota]);
    }
  
    public function cadaturmas(Request $request){
            $turmas = new Turma;
            $turmas->nome_turma = $request->nome_turma;
            $turmas->quantidade_alunos = $request->quantidade_alunos;
            $turmas->save();

            return redirect('/pcaadmin/turmas');
    }

    //Cadastro de disciplinas
    public function disciplinas(){
        $rota = \Request::route()->getName();
        $classes = Classe::All();
        $cursos = Curso::All();
        $user = auth()->user();
        return view('disciplinas', ['user' => $user, 'rota' => $rota, 'cursos' => $cursos, 'classes' => $classes ]);
    }

    public function cadasdisciplinas(Request $request){
        $disciplina = new Disciplina;
        $disciplina->nome_disc = $request->nome_disciplina;

        $curso = $request->curso;
        $classe = $request->classe;
         
           $query = DB::table('disciplinas')
           ->orderBy('id', 'desc')
           ->limit(1)
           ->get();

           echo $query;
            if(count($query) > 0 ){
                foreach ($query as $consulta) {
                    $disciplina->id = $consulta->id + 1;
                    $disciplina->save();

                    $query2 = DB::table('cursos')
                    ->where('nome_curso', $request->curso)
                    ->get();

                    $query3 = DB::table('classes')
                    ->where('nome_classe', $request->classe)
                    ->get();
                      
                         foreach ($query2 as $curso) {
                            foreach ($query3 as $classe) {
                                $disciplina2 = Disciplina::find($disciplina->id);
                                $disciplina2->cursos()->attach($curso->id);
                                $disciplina2->classes()->attach($classe->id);

                                $curso = Curso::findOrFail($curso->id);
                                $classe = Classe::findOrFail($classe->id);

                                return redirect('/pcaadmin/disciplinas')->with('msg', 'cadastro feito!');
                            }
                         }
                }
            }elseif(count($query) == 0){
                foreach ($query as $consulta) {
                    $disciplina->id = 1;
                    $disciplina->save();

                    $query2 = DB::table('cursos')
                    ->where('nome_curso', $request->curso)
                    ->get();

                    $query3 = DB::table('classes')
                    ->where('nome_classe', $request->classe)
                    ->get();
                      
                         foreach ($query2 as $curso) {
                            foreach ($query3 as $classe) {
                                $disciplina2 = Disciplina::find($disciplina->id);
                                $disciplina2->cursos()->attach($curso->id);
                                $disciplina2->classes()->attach($classe->id);

                                $curso = Curso::findOrFail($curso->id);
                                $classe = Classe::findOrFail($classe->id);

                                return redirect('/pcaadmin/disciplinas')->with('msg', 'cadastro feito!');
                            }
                         }
                }
            }
    }

    //Cadastro de cursos
    public function cursos(){
        $rota = \Request::route()->getName();
        $user = auth()->user();
        return view('cursos', ['user' => $user, 'rota' => $rota ]);
    }

    public function cadascursos(Request $request){
        $cursos = new Curso;

        $cursos->nome_curso = $request->nome_curso;

        $cursos->save();

        return redirect('pcaadmin/cursos');
    }


    //definicoes
    public function definicao(){
        $rota = \Request::route()->getName();
        $user = auth()->user();
        return view('definicoes', ['user' => $user, 'rota' => $rota ]);
    }

    public function updateinfo(Request $re){
            $user = auth()->user();
            User::findOrFail($re->id)->update($re->all());
            return redirect('/pcaadmin/definições');
    }

    public function classes(){
        $rota = \Request::route()->getName();
        $user = auth()->user();
        return view('classes', ['user' => $user, 'rota' => $rota ]);
    }

    public function cadaclasses(Request $request){
        $classes = new Classe;

        $classes->nome_classe = $request->nome_classe;

        $classes->save();

        return redirect('pcaadmin/classes')->with('msg', 'feito');
    }

    public function gerenciaralunos(){
        $turmas = Turma::all();
        $cursos = Curso::all();
        $classes = classe::all();

        $user = auth()->user();

        
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
            ->get();


        }else{
            $alunos = Aluno::all();
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
            
        
            return view('gerenciaralunos', ['user' => $user, 'rota' => $rota, 'alunos' => $alunos, 'search' => $search, 'turmas' => $turmas, 'cursos' => $cursos,'classes' => $classes,
            'query1' => $query1, 'classe_busca' => $classe_busca, 'turma_busca' => $turma_busca, 'curso_busca' => $curso_busca
        ]);
           }
           else{
                $query1 = "";
            return view('gerenciaralunos', ['user' => $user, 'rota' => $rota, 'alunos' => $alunos, 'search' => $search, 'turmas' => $turmas, 'cursos' => $cursos,'classes' => $classes, 'query1' => $query1 
        ]);
           }
       
    }

    public function gerenciarturmas(){
        $turmas = Turma::all();
        $classes = Classe::all();
        $cursos = Curso::all();
        $rota = \Request::route()->getName();
        $search = request('search');
        if($search){

            $alunos = Aluno::where([
                ['nome_aluno', 'like', '%'.$search.'%']
            ])->get();
        }else{
            $alunos = Aluno::all();
        }

        $user = auth()->user();
        return view('gerenturmas', ['user' => $user, 'rota' => $rota, 'alunos' => $alunos, 'search' => $search, 'turmas' => $turmas, 'classes' => $classes, 'cursos' => $cursos ]);
    }

    public function associar_turmas(Request $req){
        $query1 = DB::table('turmas')
                    ->where('nome_turma', $req->nome_turma)
                    ->get();

                    $query2 = DB::table('cursos')
                    ->where('nome_curso', $req->nome_curso)
                    ->get();

                    $query3 = DB::table('classes')
                    ->where('nome_classe', $req->nome_classe)
                    ->get();

                    foreach ($query1 as $q1) {   
                        foreach ($query2 as $q2) {   
                            foreach ($query3 as $q3) {   
                                $turma = Turma::find($q1->id);
                                $turma->classes()->attach($q3->id);
                                $turma->cursos()->attach($q2->id);

                                $curso = Curso::find($q2->id);
                                $curso->classes()->attach($q3->id);

                                $curso = Curso::findOrFail($q2->id);
                                $classe = Classe::findOrFail($q3->id);

                                return redirect('/pcaadmin');
                            }
                        }
                    }
        
    }
}




