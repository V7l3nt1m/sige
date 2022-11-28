<?php

namespace App\Http\Controllers\Sige;

use Illuminate\Http\Request;
use App\Models\Escola;
use App\Models\User;
use App\Models\Funcionario;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
class SigeStoreController extends Controller
{
    public function store(request $request){

        // dd( $request);
        $escolas = new Escola; 
        $user = new User;
        $func = new Funcionario;
 
        $escolas->nome_escola = $request->nome_escola;
        $escolas->n_registro = $request->n_registro;
        $escolas->contrato = $request->contrato;
        $escolas->pacote = $request->pacote;
        $escolas->valor_p_aluno = $request->valor_p_aluno;
 
       /* $n_telefone = Http::get(url: 'https://angolaapi.herokuapp.com/api/v1/validate/phone/+244'.$request->telefone)->status();
 
        if ($n_telefone == 400) {
         return redirect('/sige/cadasescolas')->with('erro', 'O Numero de Telefone é invalido. Experimente descartar o +244');
        }else{
  */
        $escolas->telefone = $request->telefone;
        $escolas->cidade = $request->city;
 
       /* $resposta = Http::get(url: 'https://angolaapi.herokuapp.com/api/v1/validate/bi/'.$request->n_bi)->status();
         if ($resposta == 400) {
             return redirect('/sige/cadasescolas')->with('erro', 'O Numero do BI é Inválido.');
         }else{*/
       $escolas->n_bi = $request->n_bi;
        $escolas->email = $request->email; 
        $escolas->outra_localizacao = $request->outra_localizacao;
              
 
        $query = DB::table('users')->orderBy('id', 'desc')->limit(1)->get();     
        $queryf2 = DB::table('funcionarios')->orderBy('id', 'desc')->limit(1)->first();
        $queryf = DB::table('funcionarios')->orderBy('id', 'desc')->limit(1)->get();
 
 
        foreach ($query as $id_ultimo) {
         $user->id = $id_ultimo->id + 1;
         $user->name = "admin.".strtolower(str_replace(" ", "", $request->nome_escola));
         $user->email = $request->email;
         $user->permissao = "pcaadmin";  
         $user->password = Hash::make($request->n_bi);
         $user->nome_escola = $request->nome_escola;
         $user->n_bi = $request->n_bi;
 
        //1234LA123
 
 
        //image upload
        if ($request->hasFile('image') &&
         $request->file('image')->isValid()) {
            # gb dev/script has file in 2022/...
             $requestImage = $request->image ;
 
             $extension = $requestImage->extension();
 
             $imageName= md5($requestImage->getClientOriginalName() .strtotime("now")) .".".$extension;
 
             $requestImage->move(public_path('img/escolas'), $imageName);
 
             $escolas->logo_escola = $imageName;
 
             $escolas->save();
             $user->save();
             if (count($queryf) == 0) {
                 $func->id = 1;
                 $func->nome = "admin.".strtolower(str_replace(" ", "", $request->nome_escola));
                 $func->senha_func = Hash::make($request->n_bi);
                 $func->data_nasc = date("Y-m-d");
                 $func->genero = "masculino";
                 $func->tipo_fun = "pcaadmin";
                 $func->telefone = $request->telefone;
                 $func->email_fun = $request->email;   
                 $func->imagem_fun = $imageName;
                 $func->user_id = $id_ultimo->id + 1;
                 $func->nome_escola = $request->nome_escola;
                 $func->save();
             }else{
                 $func->id = $queryf2->id + 1;
                 $func->nome = "admin.".strtolower(str_replace(" ", "", $request->nome_escola));
                 $func->senha_func = Hash::make($request->n_bi);
                 $func->data_nasc = date("Y-m-d");
                 $func->genero = "masculino";
                 $func->tipo_fun = "pcaadmin";
                 $func->telefone = $request->telefone;
                 $func->email_fun = $request->email;   
                 $func->imagem_fun = $imageName;
                 $func->user_id = $id_ultimo->id + 1;
                 $func->nome_escola = $request->nome_escola;
                 $func->save();
             }              
        }
         }
             return redirect('/sige/cadasescolas')->with('msg', 'Cadastro Feito com sucesso!');
       //  }
     //   }
               
     }
 
}
