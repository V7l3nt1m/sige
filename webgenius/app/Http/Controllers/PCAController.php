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
            
            $query = DB::table('funcionarios')
            ->join('users', 'users.id', 'funcionarios.user_id')
            ->where('funcionarios.user_id', $user->id)
            ->get();
           foreach ($query as $funcionario) {
            $imagem_fun = $funcionario->imagem_fun;
            return view('PCA_admin', ['user' => $user, 'rota' => $rota, 'imagem_fun' => $imagem_fun]);
            
           }

      
           
     
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
        $aluno1->senha_aluno = "Aluno2022";

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
                                            return redirect('/pcaadmin/cadasaluno')->with('msg', 'Cadastro Feito com sucesso!');
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
                                            return redirect('/pcaadmin/cadasaluno')->with('msg', 'Cadastro Feito com sucesso!');
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
        $turmas = Turma::all();
        $cursos = Curso::all();
        $classes = Classe::all();
        $disciplinas = Disciplina::all();

        $user = auth()->user();

     
            return view('cadafuncionario', ['user' => $user, 'rota' => $rota, 'turmas' => $turmas, 'disciplinas' => $disciplinas, 'cursos' => $cursos, 'classes' => $classes]);

        
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
                $consulta = DB::table('funcionarios')
                ->select('id')
                ->orderBy('id', 'desc')
                ->limit(1)
                ->get();

            if(count($consulta) > 0){
                foreach ($consulta as $k) {
                    $funcio->id = $k->id + 1;
                    foreach ($query as $q) {
                        $user->id = $q->id + 1;
                        $funcio->user_id = $q->id + 1;
                        
                            if(strcasecmp($req->funcao, "professor") == 0 && isset($req->curso) == 1 && isset($req->classe) == 1 && isset($req->turma) == 1 && isset($req->disciplina) == 1) {
                                $query2 = DB::table('cursos')
                            ->where('nome_curso', $req->curso)
                            ->get();
        
                            $query3 = DB::table('classes')
                            ->where('nome_classe', $req->classe)
                            ->get();
        
                            $query4 = DB::table('turmas')
                            ->where('nome_turma', $req->turma)
                            ->get();

                            $query5 = DB::table('disciplinas')
                            ->where('nome_disc', $req->disciplina)
                            ->get();
                            
                                $user->save();    
                                $funcio->save();
                            
                            foreach ($query2 as $cursos) {
                                foreach ($query3 as $classes) {
                                    foreach ($query4 as $turmas) {
                                        foreach ($query5 as $disciplinas) {
                                            
                                            $funcionarios = Funcionario::find($funcio->id);
                                            $funcionarios->cursos()->attach($cursos->id);
                                            $funcionarios->classes()->attach($classes->id);
                                            $funcionarios->turmas()->attach($turmas->id);
                                            $funcionarios->disciplinas()->attach($disciplinas->id);
        
                                            $curso = Curso::findOrFail($cursos->id);
                                            $classe = Classe::findOrFail($classes->id);
                                            $turma = Turma::findOrFail($turmas->id);
                                            $disciplina = Disciplina::findOrFail($disciplinas->id);
                                                                         
                                return redirect('/pcaadmin/funcionarios')->with('msg','Cadastro feito com sucesso!');
                                    }
                                }
                                }
                            }
                            
                            }elseif(strcasecmp($req->funcao, "professor") == 0 && (isset($req->curso) == 0 || isset($req->classe) == 0 || isset($req->turma) == 0 || isset($req->disciplina) == 0)){
                                return redirect('/pcaadmin/funcionarios')->with('erro' ,'Ocorreu um erro, Não foi associado turma, classe, curso ou Disciplina do Professor');

                            }elseif(($req->funcao != "professor") && (isset($req->curso) == 1 || isset($req->classe) == 1 || isset($req->turma) == 1 || isset($req->disciplina) == 1)){
                                return redirect('/pcaadmin/funcionarios')->with('erro' ,'Ocorreu um erro, O funcionario não é um professor');
                            }
                            else{
                                $user->save();    
                                $funcio->save();    
                                return redirect('/pcaadmin/funcionarios')->with('msg' ,'Cadastro feito com sucesso!');
                            }
        
        
                        
                        }
                }
                
            }else{
                 
                $funcio->id = 1;
                foreach ($query as $q) {
                    $user->id = $q->id + 1;
                    $funcio->user_id = $q->id + 1;
                if (strcasecmp($req->funcao, "professor") == 0) {
                    $query2 = DB::table('cursos')
                ->where('nome_curso', $req->curso)
                ->get();

                $query3 = DB::table('classes')
                ->where('nome_classe', $req->classe)
                ->get();

                $query4 = DB::table('turmas')
                ->where('nome_turma', $req->turma)
                ->get();

                $query5 = DB::table('disciplinas')
                ->where('nome_disc', $req->disciplina)
                ->get();

                    $user->save();    
                    $funcio->save();
                foreach ($query2 as $cursos) {
                    foreach ($query3 as $classes) {
                        foreach ($query4 as $turmas) {
                            foreach ($query5 as $disciplinas) {
                                $funcionarios = Funcionario::find($funcio->id);
                                $funcionarios->cursos()->attach($cursos->id);
                                $funcionarios->classes()->attach($classes->id);
                                $funcionarios->turmas()->attach($turmas->id);
                                $funcionarios->disciplinas()->attach($disciplinas->id);


                                $curso = Curso::findOrFail($cursos->id);
                                $classe = Classe::findOrFail($classes->id);
                                $turma = Turma::findOrFail($turmas->id);
                                $disciplina = Disciplina::findOrFail($disciplinas->id);

                                           
                    
                    return redirect('/pcaadmin/funcionarios')->with('msg','Cadastro feito com sucesso!');
                        }
                    }
                    }
                }
                
                }else{
                    $user->save();    
                    $funcio->save();    
                    return redirect('/pcaadmin/funcionarios')->with('msg' ,'Cadastro feito com sucesso!');
                }
            }
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
        $cursos = Curso::all();
        $classes = Classe::all();
        $user = auth()->user();

        return view('cadaturma', ['user' => $user, 'rota' => $rota, 'cursos' => $cursos, 'classes' => $classes]);
    }
  
    public function cadaturmas(Request $request){
            $turmas = new Turma;
            $turmas->nome_turma = $request->nome_turma;
            $curso = $request->curso_turma;
            $classe = $request->classe_turma;
            
            $query_curso = DB::table('cursos')
            ->select('id')
            ->where('nome_curso', $curso)
            ->get();

            $query_classe = DB::table('classes')
            ->select('id')
            ->where('nome_classe', $classe)
            ->get();

            $turma = DB::table('turmas')
            ->orderBy('id', 'desc')
            ->limit(1)
            ->get(); 

            if (count($turma) == 0) {
                $turmas->id = 1;
                $turmas->save();

                foreach ($query_curso as $curso_id) {
                    foreach ($query_classe as $classe_id) {

                        $cadasturma = Turma::find($turmas->id);
                        $cadasturma->classes()->attach($classe_id->id);
                        $cadasturma->cursos()->attach($curso_id->id);

                        $curso = Curso::findOrFail($curso_id->id);
                        $classe = Classe::findOrFail($classe_id->id);

                        return redirect('/pcaadmin/turmas')->with('msg', 'Cadastro feito com sucesso!');
    
    
                    }
                }



            }else{
                foreach ($turma as $turma_id) {
                    $turmas->id = $turma_id->id + 1;
                    $turmas->save();

                    foreach ($query_curso as $curso_id) {
                        foreach ($query_classe as $classe_id) {
    
                            $cadasturma = Turma::find($turmas->id);
                            $cadasturma->classes()->attach($classe_id->id);
                            $cadasturma->cursos()->attach($curso_id->id);
    
                            $curso = Curso::findOrFail($curso_id->id);
                            $classe = Classe::findOrFail($classe_id->id);
    
                            return redirect('/pcaadmin/turmas')->with('msg', 'Cadastro feito com sucesso!');
        
        
                        }
                    }
                }
            }


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

            $query_curso = DB::table('cursos')
            ->select('id')
            ->where('nome_curso', $curso)
            ->get();

            $query_classe = DB::table('classes')
            ->select('id')
            ->where('nome_classe', $classe)
            ->get();
         
           $query = DB::table('disciplinas')
           ->orderBy('id', 'desc')
           ->limit(1)
           ->get();

            if(count($query) != 0 ){
                foreach ($query as $consulta) {
                    $disciplina->id = $consulta->id + 1;
                    $disciplina->save();
                      
                         foreach ($query_curso as $curso_id) {
                            foreach ($query_classe as $classe_id) {
                                $disciplina2 = Disciplina::find($disciplina->id);
                                $disciplina2->cursos()->attach($curso_id->id);
                                $disciplina2->classes()->attach($classe_id->id);

                                $curso = Curso::findOrFail($curso_id->id);
                                $classe = Classe::findOrFail($classe_id->id);

                                return redirect('/pcaadmin/disciplinas')->with('msg', 'Cadastro feito!');
                            }
                         }
                }
            }else{
                    $disciplina->id = 1;
                    $disciplina->save();
                      
                    foreach ($query_curso as $curso_id) {
                        foreach ($query_classe as $classe_id) {
                                $disciplina2 = Disciplina::find($disciplina->id);
                                $disciplina2->cursos()->attach($curso_id->id);
                                $disciplina2->classes()->attach($classe_id->id);

                                $curso = Curso::findOrFail($curso_id->id);
                                $classe = Classe::findOrFail($classe_id->id);

                                return redirect('/pcaadmin/disciplinas')->with('msg', 'Cadastro feito!');
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

    public function updateinfo(Request $request){
        $user = auth()->user();
        $nome_user = $request->nome_user;
        $senha1 = $request->password1;
        $senha2 = $request->password2;

        $query2 = DB::table('users')
        ->join('funcionarios', 'users.id', 'funcionarios.user_id')
        ->where('funcionarios.user_id', $user->id)
        ->get();


           foreach ($query2 as $q2) {
                if(strcasecmp($senha1, $senha2) == 0 && ! Hash::check($senha1, $q2->senha_func)){
                    
                    $senha_func = Hash::make($senha1);
                    if($request->hasfile('image') && $request->file('image')->isValid()){

                        $requestImage = $request->image;
        
                        $extension = $requestImage->extension();
        
                        $imageName = md5($requestImage->getClientOriginalName() . strtotime("now")) . "." . $extension;
        
                        $requestImage->move(public_path('img/funcionarios'), $imageName);
        
                        $funcio->imagem_fun = $imageName;

                    Funcionario::where('id', $request->id)
                    ->update(['senha_func' => $senha_func],
                            ['nome' => $nome_user],
                            ['imagem_fun' => $funcio->imagem_fun]
                    )
                    ;
                    User::where('id', $user->id)
                    ->update(['name', $nome_user],
                        ['password' => $senha_func]);

                    return redirect('/pcaadmin/definições')->with('msg', 'Senha alterada com sucesso!'); 
                    }
                }
                elseif(strcasecmp($senha1, $senha2) != 0){
                    return redirect('/pcaadmin/definições')->with('msg', 'As senhas não coincidem');
                }elseif(Hash::check($senha1, $q2->senha_func)){
                    return redirect('/pcaadmin/definições')->with('msg', 'A senha já existe');
                } 
                  
            }  

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
        $alunos2 = Aluno::all();

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
            ->orWhere('num_processo', 'like', '%'.$search.'%')
            ->orWhere('turmas.nome_turma', 'like', '%'.$search.'%')
            ->orWhere('classes.nome_classe', 'like', '%'.$search.'%')
            ->orWhere('cursos.nome_curso', 'like', '%'.$search.'%')
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
            'query1' => $query1, 'classe_busca' => $classe_busca, 'turma_busca' => $turma_busca, 'curso_busca' => $curso_busca, 'alunos2' => $alunos2
        ]);
           }
           else{
                $query1 = "";
            return view('gerenciaralunos', ['user' => $user, 'rota' => $rota, 'alunos' => $alunos, 'search' => $search, 'turmas' => $turmas, 'cursos' => $cursos,'classes' => $classes, 'query1' => $query1 , 'alunos2' => $alunos2
        ]);
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

        $user = auth()->user();
        return view('gerenturmas', ['user' => $user, 'rota' => $rota,'turmas' => $turmas, 'classes' => $classes, 'cursos' => $cursos, 'query' => $query]);
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

                                return redirect('/pcaadmin/gerenciarturmas')->with('msg', 'Associação Concluida!');
                            }
                        }
                    }
        
    }

    //perfil
    public function perfil2(Request $request){
        $user = \Auth::user();

        $funcionarios = DB::table('users')
        ->join('funcionarios', 'users.id', 'funcionarios.user_id')
        ->where('funcionarios.user_id', $user->id)
        ->get();

            return view('ver_perfil2', ['user' => $user, 'funcionarios' => $funcionarios]);   

        
          
    }

    public function defi_admin(){
        $user = \Auth::user();

        $funcionarios = DB::table('users')
        ->join('funcionarios', 'users.id', 'funcionarios.user_id')
        ->where('funcionarios.user_id', $user->id)
        ->get();

        
        foreach ($funcionarios as $funcionario) {
            return view('admin_defi', ['user' => $user, 'funcionario' => $funcionario]);   
        }
                             

            
        }
//gerenciar funcionarios
        public function gerenciarfuncio(){
        $user = auth()->user();
        $rota = \Request::route()->getName();

        $search = request('search');
        if($search){

            $funcionarios = DB::table('funcionarios')
            ->where('nome', 'like', '%'.$search.'%')
            ->orWhere('tipo_fun', 'like', '%'.$search.'%')
            ->get();
        }else{
            $funcionarios = Funcionario::all();
        }
        return view('g_func', ['user' => $user, 'rota' => $rota,
         'funcionarios' => $funcionarios, 'search' => $search]);
          
       
        }
        //destroy alunos
        public function destroy_alunos($id){
            Aluno::findOrFail($id)->delete();

            return redirect('/pcaadmin/alunos')->with('msg', 'Aluno Eliminado com sucesso!');
        }
        //eliminar funcionario
        public function destroy_funcionarios($id){
            $user_funcionario = DB::table('funcionarios')
            ->select('users.id')
            ->join('users', 'users.id', 'funcionarios.user_id')
            ->where('funcionarios.id', $id)
            ->get();


        $query1 = DB::table('funcionarios')
       ->join('classe_funcionario', 'funcionarios.id', 'classe_funcionario.funcionario_id')
       ->join('classes', 'classes.id', 'classe_funcionario.classe_id')
       ->where('funcionarios.id', $id)
       ->get();

       $query2 = DB::table('funcionarios')
       ->join('curso_funcionario', 'funcionarios.id', 'curso_funcionario.funcionario_id')
       ->join('cursos', 'cursos.id', 'curso_funcionario.curso_id')
       ->where('funcionarios.id', $id)
       ->get();

       $query3 = DB::table('funcionarios')
       ->join('funcionario_turma', 'funcionarios.id', 'funcionario_turma.funcionario_id')
       ->join('turmas', 'turmas.id', 'funcionario_turma.turma_id')
       ->where('funcionarios.id', $id)
       ->get();

       $query4 = DB::table('funcionarios')
       ->join('disciplina_funcionario', 'funcionarios.id', 'disciplina_funcionario.funcionario_id')
       ->join('disciplinas', 'disciplinas.id', 'disciplina_funcionario.disciplina_id')
       ->where('funcionarios.id', $id)
       ->get();
            $funcionario = Funcionario::findOrFail($id);

            foreach ($user_funcionario as $user) {
                $usuario = User::findOrFail($user->id);
                foreach ($query1 as $cla) {
                    $funcionario->classes()->detach($cla->id);
                    foreach ($query2 as $cur) {
                        $funcionario->cursos()->detach($cur->id);
                        foreach ($query3 as $tur) {
                            $funcionario->turmas()->detach($tur->id);
                            foreach ($query4 as $disc) {
                                $funcionario->disciplinas()->detach($disc->id);

                                $funcionario->delete();
                                $usuario->delete();  
                                return redirect('/pcaadmin/gerenfuncionarios')->with('msg', 'Funcionario Eliminado com sucesso!');

                            }
                        }
                    }
                }
            }            
                

        }

         //edit alunos
         
    public function edit_alunos($id){
        $user = auth()->user();
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

                return view('edit.edit_aluno', [ 'nome_turma' => $nome_turma,'nome_classe' => $nome_classe, 'nome_curso' => $nome_curso,  'user' => $user, 'aluno' => $aluno, 'turmas' => $turmas, 'classes' => $classes, 'cursos' => $cursos, 'rota' => $rota]);
            }
        }
       }
        
    }

    public function update_alunos(Request $request){
        $query = Turma::where('nome_turma', $request->nome_turma)->get();
        $query2 = Curso::where('nome_curso', $request->nome_curso)->get();
        $query3 = Classe::where('nome_classe', $request->nome_classe)->get();

        if($request->hasfile('image') && $request->file('image')->isValid()){

            $requestImage = $request->image;

            $extension = $requestImage->extension();

            $imageName = md5($requestImage->getClientOriginalName() . strtotime("now")) . "." . $extension;

            $requestImage->move(public_path('img/alunos'), $imageName);

            foreach ($query as $tur) {
                foreach ($query2 as $curs) {
                    foreach ($query3 as $class) {
                        Aluno::where('id', $request->id)
                        ->update(['nome_aluno' => $request->nome_aluno]
                        );
    
                        Aluno::where('id', $request->id)
                        ->update(['email_aluno' => $request->email]
                        );
    
                        Aluno::where('id', $request->id)
                        ->update( ['telefone_aluno' => $request->telefone]
                        );
                        Aluno::where('id', $request->id)
                        ->update(['num_processo' => $request->n_processo]
                        );
                        Aluno::where('id', $request->id)
                        ->update(['genero' => $request->genero_aluno]
                        );
                        Aluno::where('id', $request->id)
                        ->update(['data_nasc' => $request->data_nasc]
                        );
                        Aluno::where('id', $request->id)
                        ->update(['turma_id' => $tur->id]
                        );
                        Aluno::where('id', $request->id)
                        ->update(['imagem_aluno' => $imageName]
                        );
                        Aluno::where('id', $request->id)
                        ->update(['classe_id' => $class->id]
                        );
                        Aluno::where('id', $request->id)
                        ->update(['curso_id' => $curs->id]
                        );
                       

                        return redirect('/pcaadmin/alunos')->with('msg', 'Dados alterados com sucesso!');

                    }
                }
            }
           
    
    }else{
        foreach ($query as $tur) {
            foreach ($query2 as $curs) {
                foreach ($query3 as $class) {

                   Aluno::where('id', $request->id)
                    ->update(['nome_aluno' => $request->nome_aluno]
                    );

                    Aluno::where('id', $request->id)
                    ->update(['email_aluno' => $request->email]
                    );

                    Aluno::where('id', $request->id)
                    ->update( ['telefone_aluno' => $request->telefone]
                    );
                    Aluno::where('id', $request->id)
                    ->update(['num_processo' => $request->n_processo]
                    );
                    Aluno::where('id', $request->id)
                    ->update(['genero' => $request->genero_aluno]
                    );
                    Aluno::where('id', $request->id)
                    ->update(['data_nasc' => $request->data_nasc]
                    );
                    Aluno::where('id', $request->id)
                    ->update(['turma_id' => $tur->id]
                    );
                    Aluno::where('id', $request->id)
                    ->update(['classe_id' => $class->id]
                    );
                    Aluno::where('id', $request->id)
                    ->update(['curso_id' => $curs->id]
                    );

                    return redirect('/pcaadmin/alunos')->with('msg', 'Dados alterados com sucesso!');

                }
            }
        }
    }
}

//adicionarturma
public function adicionarturma($id){
    $user = auth()->user();
    $rota = \Request::route()->getName();

    $turmas = Turma::all();
       $classes = Classe::all();
       $cursos = Curso::all();

       $funcionario = Funcionario::findOrFail($id);


                return view('adicionar.adicionar_turma', [  'user' => $user, 'turmas' => $turmas, 'classes' => $classes, 'cursos' => $cursos, 'rota' => $rota, 'funcionario' => $funcionario]);
            

}

public function adicionarturma_post(Request $request){
    $query = Turma::where('nome_turma', $request->nome_turma)->get();
    $query2 = Curso::where('nome_curso', $request->nome_curso)->get();
    $query3 = Classe::where('nome_classe', $request->nome_classe)->get();

    foreach ($query as $turma) {
        foreach ($query2 as $curso) {
            foreach ($query3 as $classe) {
                $funcionario = Funcionario::find($request->id);

                $funcionario->turmas()->attach($turma->id);
                $funcionario->cursos()->attach($curso->id);
                $funcionario->classes()->attach($classe->id);

                
                $cursos = Curso::findOrFail($curso->id);
                $classes = Classe::findOrFail($classe->id);
                $turmas = Turma::findOrFail($turma->id);

                return redirect('/pcaadmin/gerenfuncionarios')->with('msg', 'Turma adicionada com sucesso!');

            }
        }
    }

}

public function edit_func($id){
    $user = auth()->user();
        $rota = \Request::route()->getName();
         
       $turmas = Turma::all();
       $classes = Classe::all();
       $cursos = Curso::all();
       $disciplinas = Disciplina::all();
       $funcionario = Funcionario::findOrFail($id);

       $query1 = DB::table('funcionarios')
       ->select('funcionarios.nome', 'classes.nome_classe')
       ->join('classe_funcionario', 'funcionarios.id', 'classe_funcionario.funcionario_id')
       ->join('classes', 'classes.id', 'classe_funcionario.classe_id')
       ->where('funcionarios.id', $id)
       ->get();

       $query2 = DB::table('funcionarios')
       ->select('funcionarios.nome', 'cursos.nome_curso')
       ->join('curso_funcionario', 'funcionarios.id', 'curso_funcionario.funcionario_id')
       ->join('cursos', 'cursos.id', 'curso_funcionario.curso_id')
       ->where('funcionarios.id', $id)
       ->get();

       $query3 = DB::table('funcionarios')
       ->select('funcionarios.nome', 'turmas.nome_turma')
       ->join('funcionario_turma', 'funcionarios.id', 'funcionario_turma.funcionario_id')
       ->join('turmas', 'turmas.id', 'funcionario_turma.turma_id')
       ->where('funcionarios.id', $id)
       ->get();

       $query4 = DB::table('funcionarios')
       ->select('funcionarios.nome', 'disciplinas.nome_disc')
       ->join('disciplina_funcionario', 'funcionarios.id', 'disciplina_funcionario.funcionario_id')
       ->join('disciplinas', 'disciplinas.id', 'disciplina_funcionario.disciplina_id')
       ->where('funcionarios.id', $id)
       ->get();
       


                foreach ($query4 as $disciplina) {
                    $nome_disciplina = $disciplina->nome_disc;
                    return view('edit.edit_func', ['user' => $user, 'query1' => $query1, 'query2' => $query2, 'query3' => $query3, 'query4' => $query4, 'nome_disciplina' => $nome_disciplina,  'funcionario' => $funcionario, 'rota' => $rota, 'turmas' => $turmas, 'classes' => $classes, 'cursos' => $cursos, 'disciplinas' => $disciplinas]);
                }
          
        
    
}

public function update_func(Request $req){
    $query = DB::table('funcionarios')
    ->select('users.id')
    ->join('users', 'users.id', 'funcionarios.user_id')
    ->where('funcionarios.id', $req->id)->get();
    
    $dados1 = DB::table('funcionarios')
       ->select('classes.id', 'classes.nome_classe')
       ->join('classe_funcionario', 'funcionarios.id', 'classe_funcionario.funcionario_id')
       ->join('classes', 'classes.id', 'classe_funcionario.classe_id')
       ->where('funcionarios.id', $req->id)
       ->get();

       $dados2 = DB::table('funcionarios')
       ->select('cursos.id', 'cursos.nome_curso')
       ->join('curso_funcionario', 'funcionarios.id', 'curso_funcionario.funcionario_id')
       ->join('cursos', 'cursos.id', 'curso_funcionario.curso_id')
       ->where('funcionarios.id', $req->id)
       ->get();

       $dados3 = DB::table('funcionarios')
       ->select('turmas.id', 'turmas.nome_turma')
       ->join('funcionario_turma', 'funcionarios.id', 'funcionario_turma.funcionario_id')
       ->join('turmas', 'turmas.id', 'funcionario_turma.turma_id')
       ->where('funcionarios.id', $req->id)
       ->get();

       $dados4 = DB::table('funcionarios')
       ->select('disciplinas.id', 'disciplinas.nome_disc')
       ->join('disciplina_funcionario', 'funcionarios.id', 'disciplina_funcionario.funcionario_id')
       ->join('disciplinas', 'disciplinas.id', 'disciplina_funcionario.disciplina_id')
       ->where('funcionarios.id', $req->id)
       ->get();



    $disciplina = $req->disciplina;
    $turma = $req->turma;
    $curso = $req->curso;
    $classe = $req->classe;

    $query1 = DB::table('disciplinas')
    ->where('nome_disc', $disciplina)
    ->get();


    $query2 = DB::table('turmas')
    ->where('nome_turma', $turma)
    ->get();

    $query3 = DB::table('cursos')
    ->where('nome_curso', $curso)
    ->get();

    $query4 = DB::table('classes')
    ->where('nome_classe', $classe)
    ->get();

    $funci = Funcionario::findOrFail($req->id);

        foreach ($query as $user) {
    $nome = $req->nome_func;
    Funcionario::where('id', $req->id)->update(['nome' => $nome]);
    User::where('id', $user->id)->update(['name' => $nome]);
    
    $tipo_fun = $req->funcao;
    Funcionario::where('id', $req->id)->update(['tipo_fun' => $tipo_fun]);
    User::where('id', $user->id)->update(['permissao' => $tipo_fun]);

    $telefone = $req->telefone;
    Funcionario::where('id', $req->id)->update(['telefone' => $telefone]);

    $email_fun = $req->email;
    Funcionario::where('id', $req->id)->update(['email_fun' => $email_fun]);
    User::where('id', $user->id)->update(['email' => $email_fun]);

    $genero = $req->genero_func;
    Funcionario::where('id', $req->id)->update(['genero' => $genero]);

    $data_nasc = $req->data_nasc;
    Funcionario::where('id', $req->id)->update(['data_nasc' => $data_nasc]);



    if($req->hasfile('image') && $req->file('image')->isValid()){

        $requestImage = $req->image;

        $extension = $requestImage->extension();

        $imageName = md5($requestImage->getClientOriginalName() . strtotime("now")) . "." . $extension;

        $requestImage->move(public_path('img/funcionarios'), $imageName);

        $imagem_fun = $imageName;
        Funcionario::where('id', $req->id)->update(['imagem_fun' => $imagem_fun]);

        foreach ($dados1 as $d_classe) {
           foreach ($dados2 as $d_curso) {
            foreach ($dados3 as $d_turma) {
                foreach ($dados4 as $d_disciplina) {
        foreach ($query1 as $dis){
            $funci->disciplinas()->where('disciplina_id', $d_disciplina->id)->where('funcionario_id', $req->id)->update(['disciplina_id' => $dis->id]);
            foreach ($query2 as $tur) {
                $funci->turmas()->where('funcionario_id', $req->id)->where('turma_id', $d_turma->id)->update(['turma_id' => $tur->id]);
                foreach ($query3 as $cur) {
                    $funci->cursos()->where('curso_id', $d_curso->id)->where('funcionario_id', $req->id)->update(['curso_id' => $cur->id]);
                    foreach ($query4 as $cla) {
                        $funci->classes()->where('classe_id', $d_classe->id)->where('funcionario_id', $req->id)->update(['classe_id' => $cla->id]);

                       return redirect('/pcaadmin/gerenfuncionarios')->with('msg', 'Alterações feitas com sucesso');

                    }
                }
            }
        }
}
               }
           }
        }

}else{
    $nome = $req->nome_func;
    Funcionario::where('id', $req->id)->update(['nome' => $nome]);
    User::where('id', $user->id)->update(['name' => $nome]);
    
    $tipo_fun = $req->funcao;
    Funcionario::where('id', $req->id)->update(['tipo_fun' => $tipo_fun]);
    User::where('id', $user->id)->update(['permissao' => $tipo_fun]);

    $telefone = $req->telefone;
    Funcionario::where('id', $req->id)->update(['telefone' => $telefone]);

    $email_fun = $req->email;
    Funcionario::where('id', $req->id)->update(['email_fun' => $email_fun]);
    User::where('id', $user->id)->update(['email' => $email_fun]);

    $genero = $req->genero_func;
    Funcionario::where('id', $req->id)->update(['genero' => $genero]);

    $data_nasc = $req->data_nasc;
    Funcionario::where('id', $req->id)->update(['data_nasc' => $data_nasc]);

    foreach ($dados1 as $d_classe) {
        foreach ($dados2 as $d_curso) {
         foreach ($dados3 as $d_turma) {
             foreach ($dados4 as $d_disciplina) {
    foreach ($query1 as $dis) {
        $funci->disciplinas()->where('disciplina_id', $d_disciplina->id)->where('funcionario_id', $req->id)->update(['disciplina_id' => $dis->id]);
        foreach ($query2 as $tur) {
        $funci->turmas()->where('funcionario_id', $req->id)->where('turma_id', $d_turma->id)->update(['turma_id' => $tur->id]);
            foreach ($query3 as $cur) {
                $funci->cursos()->where('curso_id', $d_curso->id)->where('funcionario_id', $req->id)->update(['curso_id' => $cur->id]);
                foreach ($query4 as $cla) {
                $funci->classes()->where('classe_id', $d_classe->id)->where('funcionario_id', $req->id)->update(['classe_id' => $cla->id]);

                return redirect('/pcaadmin/gerenfuncionarios')->with('msg', 'Alterações feitas com sucesso');

                }
            }
        }
    }
}
         }
        }
    }

}
    }


    
    }

   



}


