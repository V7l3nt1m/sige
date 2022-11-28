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

class PCAUpdateController extends PCAController
{
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
            
           return redirect('/pcaadmin/permissoes')->with('msg','Permissão de '.$q->nome.' alterada com sucesso!');
        }
    }


//actualizar informações 
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


//update funcionarios
public function update_func(Request $req){
    $query = DB::table('funcionarios')
    ->select('users.id')
    ->join('users', 'users.id', 'funcionarios.user_id')
    ->where('funcionarios.id', $req->id)->get(); 

    $funci = Funcionario::findOrFail($req->id);

    if(strcasecmp($funci->tipo_fun, "professor") == 0){
       $dados4 = DB::table('funcionarios')
       ->select('disciplinas.id', 'disciplinas.nome_disc')
       ->join('disciplina_funcionario', 'funcionarios.id', 'disciplina_funcionario.funcionario_id')
       ->join('disciplinas', 'disciplinas.id', 'disciplina_funcionario.disciplina_id')
       ->where('funcionarios.id', $req->id)
       ->get();


    $disciplina = $req->disciplina;

    $query1 = DB::table('disciplinas')
    ->where('nome_disc', $disciplina)
    ->get();

    

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

                foreach ($dados4 as $d_disciplina) {
        foreach ($query1 as $dis){
          $funci->disciplinas()->where('disciplina_id', $d_disciplina->id)->where('funcionario_id', $req->id)->update(['disciplina_id' => $dis->id]);
             return redirect('/pcaadmin/gerenfuncionarios')->with('msg', 'Alterações feitas com sucesso');

                    }
            }
               }
else{
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

    foreach ($dados4 as $d_disciplina) {
    foreach ($query1 as $dis) {
     $funci->disciplinas()->where('disciplina_id', $d_disciplina->id)->where('funcionario_id', $req->id)->update(['disciplina_id' => $dis->id]);
    return redirect('/pcaadmin/gerenfuncionarios')->with('msg', 'Alterações feitas com sucesso');
     

    }
}

}
}
}else{
    
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
    
                 return redirect('/pcaadmin/gerenfuncionarios')->with('msg', 'Alterações feitas com sucesso');

                   }
    else{
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
    
        return redirect('/pcaadmin/gerenfuncionarios')->with('msg', 'Alterações feitas com sucesso');
        }
    
    }
    

}
}

//update turmas do funcionario
public function update_turm_func(Request $request){
    $nome_turma = $request->turma;
    $nome_curso = $request->curso;
    $nome_classe = $request->classe;

    $query = Turma::where('nome_turma', $nome_turma)->get();
    $query2 = Curso::where('nome_curso', $nome_curso)->get();
    $query3 = Classe::where('nome_classe', $nome_classe)->get();

    foreach ($query as $turma) {
        DB::table('classe_curso_disciplina_funcionario_turma')->where('id', $request->id)->update(['turma_id' => $turma->id]);
        foreach ($query2 as $curso) {
            DB::table('classe_curso_disciplina_funcionario_turma')->where('id', $request->id)->update(['curso_id' => $curso->id]);
            foreach ($query3 as $classe) {
                DB::table('classe_curso_disciplina_funcionario_turma')->where('id', $request->id)->update(['classe_id' => $classe->id]);

                return redirect('/pcaadmin/gerenfuncionarios')->with('msg', 'Alterações feitas com sucesso');
            }  
        }
    }


}
}
