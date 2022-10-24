<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Aluno;
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
        $user = auth()->user();
        return view('cadasaluno', ['user' => $user]);
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
        return view('cadafuncionario');
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

    
   
}
