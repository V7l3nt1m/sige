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

class PCAStoreController extends PCAController
{
    //cadastro de alunos
    public function store_alunos(Request $req){
        $user_cadastrado = auth()->user();

        $aluno1 = new Aluno;
        $aluno1->nome_aluno = $req->nome_aluno;
        $aluno1->num_processo = $req->n_processo;
        $aluno1->email_aluno = $req->email;
        $aluno1->genero = $req->genero_aluno;
       // $n_telefone = Http::get(url: 'https://angolaapi.herokuapp.com/api/v1/validate/phone/+244'.$req->telefone)->status();

       /* if ($n_telefone == 400) {
            return redirect('/pcaadmin/cadasaluno')->with('erro', 'O Numero de Telefone é invalido. Experimente descartar o +244');
        }else{
        $resposta = Http::get(url: 'https://angolaapi.herokuapp.com/api/v1/validate/bi/'.$req->BI)->status();
        if ($resposta == 400) {
            return redirect('/pcaadmin/cadasaluno')->with('erro', 'O Numero do BI é Inválido.');
        }else{*/
        $aluno1->telefone_aluno = $req->telefone;
        $aluno1->n_bi = $req->BI;
        $aluno1->senha_aluno = Hash::make("Aluno2022");
        $aluno1->nome_escola = $user_cadastrado->nome_escola;

        $user = new User;

        $user->name = $req->nome_aluno;
        $user->email = $req->email;
        $user->permissao = "Aluno";
        $user->n_bi = $req->BI;
        $user->password = Hash::make("Aluno2022");
        $user->nome_escola = $user_cadastrado->nome_escola;

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
                     //   }
               //     }
                   
                }

           
            }  


    }


//Cadastrar funcionarios

    public function store_funcionarios(Request $req){
        $user_cadastrado = auth()->user();

        $funcio = new Funcionario;
        $funcio->nome = $req->nome_func;
        $funcio->tipo_fun = $req->funcao;

       // $n_telefone = Http::get(url: 'https://angolaapi.herokuapp.com/api/v1/validate/phone/+244'.$req->telefone)->status();

       /* if ($n_telefone == 400) {
            return redirect('/pcaadmin/funcionarios')->with('erro', 'O Numero de Telefone é invalido. Experimente descartar o +244');
        }else{
        $resposta = Http::get(url: 'https://angolaapi.herokuapp.com/api/v1/validate/bi/'.$req->BI)->status();
        if ($resposta == 400) {
            return redirect('/pcaadmin/funcionarios')->with('erro', 'O Numero do BI é Inválido.');
        }else{*/
        $funcio->telefone = $req->telefone;
        $funcio->email_fun = $req->email;
        $funcio->genero = $req->genero_func;
        $funcio->nome_escola = $user_cadastrado->nome_escola;

        $user = new User;
        $user->name = $req->nome_func;
        $user->email = $req->email;
        $user->permissao = $req->funcao;
        $user->n_bi = $req->BI;
        $user->nome_escola = $user_cadastrado->nome_escola;
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
                                            $alunos = DB::table('alunos')
                                            ->where('turma_id', $turmas->id)
                                            ->where('classe_id', $classes->id)
                                            ->where('curso_id', $cursos->id)
                                            ->get();
                                            
                                            $funcionarios = Funcionario::find($funcio->id);
                                            $funcionarios->cursos()->attach($cursos->id, ['classe_id' => $classes->id, 'disciplina_id' => $disciplinas->id, 'turma_id' => $turmas->id]);                                                                             
        
                                            $curso = Curso::findOrFail($cursos->id);
                                            $classe = Classe::findOrFail($classes->id);
                                            $turma = Turma::findOrFail($turmas->id);
                                            $disciplina = Disciplina::findOrFail($disciplinas->id);
                                            foreach ($alunos as $al) {
                                                $nota = new Nota;

                                                $nota->disciplina = $req->disciplina;
                                                $nota->aluno_id = $al->id;
                                                $nota->save();
                                            }
                                                                         
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
                                $funcionarios->cursos()->attach($cursos->id, ['classe_id' => $classes->id, 'disciplina_id' => $disciplinas->id, 'turma_id' => $turmas->id]);                                                                             

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
        //    }
        //}
    }

            }
    }
//Termina cadastro funcionarios
  

//Cadastro de turmas
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



//cadastro de disciplinas
public function cadasdisciplinas(Request $request){
    $disciplina = new Disciplina;
    $disciplina->nome_disc = $request->nome_disciplina;

    $curso = $request->curso;
    $classe = $request->classe;

        $query_curso = DB::table('cursos')
        ->where('nome_curso', $curso)
        ->get();

        $query_classe = DB::table('classes')
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
                
    if(strcasecmp($curso, "todos") == 0) {
        $todos_cursos = DB::table('cursos')->select('id')->orderBy('id', 'asc')->get();
        $count_curso = count($todos_cursos);
        foreach ($todos_cursos as $todos) {
                foreach ($query_classe as $classe_id) {
                    $disciplina2 = Disciplina::find($disciplina->id);
                    $disciplina2->cursos()->attach($todos->id);
                    $todos->id = $todos->id + 1;
                }
                } 
        
        $disciplina2->classes()->attach($classe_id->id);
       return redirect('/pcaadmin/disciplinas')->with('msg', 'Cadastro feito!');
        
    }elseif(strcasecmp($classe, "todas") == 0){
        $todos_classes = DB::table('classes')->select('id')->get();
        foreach ($todos_classes as $todos) {
        foreach ($query_curso as $curso_id) {
                $disciplina2 = Disciplina::find($disciplina->id);
                $disciplina2->cursos()->attach($curso_id->id);
                $disciplina2->classes()->attach($todos->id);

                return redirect('/pcaadmin/disciplinas')->with('msg', 'Cadastro feito!');
            
        }
    }
         }else{

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
        }else{
                $disciplina->id = 1;
                $disciplina->save();
                  if(strcasecmp($curso, "todos") == 0) {
        $todos_cursos = DB::table('cursos')->select('id')->get();
        foreach ($todos_cursos as $todos) {
                foreach ($query_classe as $classe_id) {
                    $disciplina2 = Disciplina::find($disciplina->id);
                    $disciplina2->cursos()->attach($todos->id);
                    $disciplina2->classes()->attach($classe_id->id);

                    return redirect('/pcaadmin/disciplinas')->with('msg', 'Cadastro feito!');
                } 
        }
    }elseif(strcasecmp($classe, "todas") == 0){
        $todos_classes = DB::table('classes')->select('id')->get();
        foreach ($todos_classes as $todos) {
        foreach ($query_curso as $curso_id) {
                $disciplina2 = Disciplina::find($disciplina->id);
                $disciplina2->cursos()->attach($curso_id->id);
                $disciplina2->classes()->attach($todos->id);

                return redirect('/pcaadmin/disciplinas')->with('msg', 'Cadastro feito!');
            
        }
    }
         }else{
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
}

//cadastro de cursos
public function cadascursos(Request $request){
    $cursos = new Curso;

    $cursos->nome_curso = $request->nome_curso;

    $cursos->save();

    return redirect('pcaadmin/cursos');
}


//cadastro de classes
public function cadaclasses(Request $request){
    $classes = new Classe;

    $classes->nome_classe = $request->nome_classe;

    $classes->save();

    return redirect('pcaadmin/classes')->with('msg', 'feito');
}


public function adicionarturma_post(Request $request){
    $nota = new Nota;
    $query = Turma::where('nome_turma', $request->nome_turma)->get();
    $query2 = Curso::where('nome_curso', $request->nome_curso)->get();
    $query3 = Classe::where('nome_classe', $request->nome_classe)->get();
    $query4 = Disciplina::where('nome_disc', $request->disciplina)->first();

    foreach ($query as $turma) {
        foreach ($query2 as $curso) {
            foreach ($query3 as $classe) {
                $funcionario = Funcionario::find($request->id);

                $funcionario->cursos()->attach($curso->id, ['classe_id' => $classe->id, 'turma_id' => $turma->id, 'disciplina_id' => $query4->id]);                                                                             

                return redirect('/pcaadmin/gerenfuncionarios')->with('msg', 'Turma adicionada com sucesso!');

            }
        }
    }

}
}


