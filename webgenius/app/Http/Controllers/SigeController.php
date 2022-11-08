<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Escola;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class SigeController extends Controller
{
    public function index(){
        $user = auth()->user();
        return view('sige', ['user' => $user]);
    }

    public function webgens(){
        $events = Event::all();
             //return view('/webgeniusV');
        return view('/webgens',['events'=>$events]);
    }
    public function cadastrar(){
        return view('/events/cadastrar');
       
    }

    public function store(request $request){

       // dd( $request);
       $escolas = new Escola; 

       $escolas->nome_escola = $request->nome_escola;
       $escolas->n_registro = $request->n_registro;
       $escolas->contrato = $request->contrato;
       $escolas->pacote = $request->pacote;
       $escolas->valor_p_aluno = $request->valor_p_aluno;
       $escolas->telefone = $request->telefone;
       $escolas->cidade = $request->city;
       $escolas->n_bi = $request->n_bi;
       $escolas->email = $request->email; 
       $escolas->outra_localizacao = $request->outra_localizacao;	  


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

            return redirect('/sige/cadasescolas')->with('msg', 'Cadastro Feito com sucesso!');

       }
              
    }

    public function cadasescolas(){
        $user = auth()->user();
        return view('cadastroescolas', ['user' => $user]);
    }

    //lista de escolas

    public function lista_escolas(){
        $user = auth()->user();
        $search = request('search');
        $escolas2 = Escola::all();
        if($search){

            $escolas = Escola::where([
                ['nome_escola', 'like', '%'.$search.'%']
            ])->orWhere([['contrato', 'like', '%'.$search.'%']])
            ->orWhere([['pacote', 'like', '%'.$search.'%']])
            ->get();
        }else{
            $escolas = Escola::all();
        }
        return view('lista_escolas', ['user' => $user, 'escolas' => $escolas, 'search' => $search, 'escolas2' => $escolas2]);
    
}
public function destroy_escola($id){

    Escola::findOrFail($id)->delete();

    return redirect('/sige/listaescolas')->with('msg', 'Cadastro Eliminado com Sucesso!');
}

public function edit_escola($id){
    $user = auth()->user();
  $escola = Escola::findOrFail($id);
        return view('edit_escola', ['user' => $user, 'escola' => $escola]);
}

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

public function settings_sige(){
    $user = auth()->user();
    return view('defi_sige', ['user' => $user]);


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
        
                return redirect('/sige/definições')->with('msg', 'Senha alterada com sucesso!'); 
            }
            elseif(strcasecmp($senha1, $senha2) != 0){
                return redirect('/sige/definições')->with('erro', 'As senhas não coincidem');
            }elseif(Hash::check($senha1, $user->password)){
                return redirect('/sige/definições')->with('erro', 'A senha já existe');
            }
            
        

   
}
}
