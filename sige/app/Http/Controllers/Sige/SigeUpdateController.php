<?php

namespace App\Http\Controllers\Sige;

use Illuminate\Http\Request;
use App\Models\Escola;
use App\Models\User;
use App\Models\Funcionario;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
class SigeUpdateController extends Controller
{
    
public function update_escolas(Request $request){
    $nome_escola = $request->nome_escola;
    $n_registro = $request->n_registro;
    $contrato = $request->contrato;
    $pacote = $request->pacote;
    $valor_p_aluno = $request->valor_p_aluno;
    $telefone = $request->telefone;
    $cidade = $request->city;
    $n_bi = $request->n_bi;
    $email = $request->email; 
    $outra_localizacao = $request->outra_localizacao;


if ($request->hasFile('image') &&
     $request->file('image')->isValid()) {
        # gb dev/script has file in 2022/...
         $requestImage = $request->image ;

         $extension = $requestImage->extension();

         $imageName= md5($requestImage->getClientOriginalName() .strtotime("now")) .".".$extension;

         $requestImage->move(public_path('img/escolas'), $imageName);

         $logo_escola = $imageName;

         Escola::where('id', $request->id)->update(['nome_escola' => $nome_escola]);
         Escola::where('id', $request->id)->update(['n_registro' => $n_registro]);
         Escola::where('id', $request->id)->update(['contrato' => $contrato]);
         Escola::where('id', $request->id)->update(['valor_p_aluno' => $valor_p_aluno]);
         Escola::where('id', $request->id)->update(['telefone' => $telefone]);
         Escola::where('id', $request->id)->update(['cidade' => $cidade]);
         Escola::where('id', $request->id)->update(['n_bi' => $n_bi]);
         Escola::where('id', $request->id)->update(['email' => $email]);
         Escola::where('id', $request->id)->update(['outra_localizacao' => $outra_localizacao]);
         Escola::where('id', $request->id)->update(['logo_escola' => $logo_escola]);

                  return redirect('/sige/listaescolas')->with('msg', 'Alterações Feitas com Sucesso!');
     }else{
         Escola::where('id', $request->id)->update(['nome_escola' => $nome_escola]);
         Escola::where('id', $request->id)->update(['n_registro' => $n_registro]);
         Escola::where('id', $request->id)->update(['contrato' => $contrato]);
         Escola::where('id', $request->id)->update(['valor_p_aluno' => $valor_p_aluno]);
         Escola::where('id', $request->id)->update(['telefone' => $telefone]);
         Escola::where('id', $request->id)->update(['cidade' => $cidade]);
         Escola::where('id', $request->id)->update(['n_bi' => $n_bi]);
         Escola::where('id', $request->id)->update(['email' => $email]);
         Escola::where('id', $request->id)->update(['outra_localizacao' => $outra_localizacao]);
              
                   return redirect('/sige/listaescolas')->with('msg', 'Alterações Feitas com Sucesso!');
     }



}



public function update_sige(Request $request){
    $senha1 = $request->password1;
    $senha2 = $request->password2;
    $user = auth()->user();
    $nome_user = $request->nome_user;


            if(strcasecmp($senha1, $senha2) == 0 && ! Hash::check($senha1, $user->password)){
                $senha = Hash::make($senha1);
                
               User::where('id', $user->id)
                ->update(['name' => $nome_user]);
                         
                User::where('id', $user->id)
                         ->update(['password' => $senha]);
        
                return redirect('/sige/definições')->with('msg', 'Informações alteradas com sucesso!'); 
            }
            elseif(strcasecmp($nome_user, $user->name) != 0){
                if(strcasecmp($senha1, $senha2) == 0 && Hash::check($senha1, $user->password)){
                    $senha = Hash::make($senha1);
                   User::where('id', $user->id)
                    ->update(['name' => $nome_user]);
                             
                    User::where('id', $user->id)
                             ->update(['password' => $senha]);
            
                    return redirect('/sige/definições')->with('msg', 'Nome de usuário alterado com sucesso!'); 
                }elseif(strcasecmp($nome_user, $user->name) != 0 && strcasecmp($senha1, $senha2) != 0){
                    return redirect('/sige/definições')->with('erro', 'As senhas não coincidem');
                }
            }
            elseif(strcasecmp($senha1, $senha2) != 0){
                return redirect('/sige/definições')->with('erro', 'As senhas não coincidem');
            }
            elseif(strcasecmp($nome_user, $user->name) == 0 && Hash::check($senha1, $user->password)){
                return redirect('/sige/definições')->with('erro', 'A senha já existe');
            }
            
        

   
}
}
