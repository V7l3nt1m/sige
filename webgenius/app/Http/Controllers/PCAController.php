<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Aluno;
use App\Models\Turma;
use App\Models\Disciplina;
use App\Models\Curso;
use App\Models\Funcionario;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;



class PCAController extends Controller
{
    public function index(){
        $user = auth()->user();
        return view('PCA_admin', ['user' => $user]);
    }

    public function cadasaluno(){

        $search2 = request('search2');

        if($search2){

            $alunos = Aluno::where([
                ['nome_aluno', 'like', '%'.$search2.'%']
            ])->get();
        }else{
            $alunos = Aluno::all();
        }
        $user = auth()->user();
        return view('cadasaluno', ['user' => $user, 'alunos' => $alunos, 'search2' => $search2]);
    }


    public function store_alunos(Request $req){
        $aluno1 = new Aluno;
        $aluno1->nome_aluno = $req->nome_aluno;
        $aluno1->num_processo = $req->n_processo;
        $aluno1->telefone_aluno = $req->telefone;
        $aluno1->email_aluno = $req->email>
        $aluno1->genero = $req->genero_aluno;
        $senha1 = $req->senha1;
        $senha2 = $req->senha2;
         
        if(strcasecmp($senha1, $senha2) == 0){
            $aluno1->senha_aluno = Hash::make($senha1);

            //image upload
            if($req->hasfile('image') && $req->file('image')->isValid()){

                $requestImage = $req->image;

                $extension = $requestImage->extension();

                $imageName = md5($requestImage->getClientOriginalName() . strtotime("now")) . "." . $extension;

                $requestImage->move(public_path('img/alunos'), $imageName);

                $aluno1->imagem_aluno = $imageName;

                $aluno1->data_nasc = $req->data_nasc;

                $aluno1->save();
                return redirect('/pcaadmin');
            }

        }else{
            return redirect('/pcaadmin');
            echo "falhou as senhas nao coincidem";
        }


    }

    public function cadafuncionario(){
        $user = auth()->user();
        return view('cadafuncionario', ['user' => $user]);
    }

    public function store_funcionarios(Request $req){
        $funcio = new Funcionario;
        $funcio->nome = $req->nome_func;
        $funcio->tipo_fun = $req->funcao;
        $funcio->telefone = $req->telefone;
        $funcio->email_fun = $req->email>
        $funcio->genero = $req->genero_func;
        $senha1 = $req->senha1;
        $senha2 = $req->senha2;
         
        if(strcasecmp($senha1, $senha2) == 0){
            $funcio->senha_func = Hash::make($senha1);

            //image upload
            if($req->hasfile('image') && $req->file('image')->isValid()){

                $requestImage = $req->image;

                $extension = $requestImage->extension();

                $imageName = md5($requestImage->getClientOriginalName() . strtotime("now")) . "." . $extension;

                $requestImage->move(public_path('img/funcionarios'), $imageName);

                $funcio->imagem_fun = $imageName;

                $funcio->data_nasc = $req->data_nasc;

                $funcio->save();
                return redirect('/pcaadmin');
            }

        }else{
            return redirect('/pcaadmin');
            echo "falhou as senhas nao coincidem";
        }
    }


    public function permissoes(){
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
        return view('permissoes', ['search' => $search, 'funcionarios' => $funcionarios, 'allfunc' => $allfunc, 'user' => $user ]);
    }  
    //cadastro de turmas
    public function turmas(){
        $user = auth()->user();
        return view('cadaturma', ['user' => $user]);
    }
  
    public function cadaturmas(Request $request){
            $turmas = new Turma;
            $turmas->nome_turma = $request->nome_turma;
            $turmas->save();

            return redirect('/pcaadmin/turmas');
    }

    //Cadastro de disciplinas
    public function disciplinas(){
        $user = auth()->user();
        return view('disciplinas', ['user' => $user]);
    }

    public function cadasdisciplinas(Request $request){
        $disciplina = new Disciplina;

        $disciplina->nome_disc = $request->nome_disciplina;

        $disciplina->save();

        return redirect('pcaadmin/disciplinas');
    }

    //Cadastro de cursos
    public function cursos(){
        $user = auth()->user();
        return view('cursos', ['user' => $user]);
    }

    public function cadascursos(Request $request){
        $cursos = new Curso;

        $cursos->nome_curso = $request->nome_curso;

        $cursos->save();

        return redirect('pcaadmin/cursos');
    }


    //definicoes
    public function definicao(){
        $user = auth()->user();
        return view('definicoes', ['user' => $user]);
    }

    public function updateinfo(Request $re){
            $user = auth()->user();
            User::findOrFail($re->id)->update($re->all());
            return redirect('/pcaadmin/definições');
    }
}




