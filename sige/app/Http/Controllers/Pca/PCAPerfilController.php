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

class PCAPerfilController extends PCAController
{
       //perfil
       public function perfil2(Request $request){
        $pagina_anterior = $request->headers->get('referer');
        $user = \Auth::user();
        $rota = \Request::route()->getName(); 
        $logo_escola = DB::table('escolas')
        ->select('logo_escola')
        ->where('nome_escola', $user->nome_escola)->first();
        $funcionarios = DB::table('users')
        ->join('funcionarios', 'users.id', 'funcionarios.user_id')
        ->where('funcionarios.user_id', $user->id)
        ->get();
        
        $query = DB::table('funcionarios')
        ->join('users', 'users.id', 'funcionarios.user_id')
        ->where('funcionarios.user_id', $user->id)
        ->get();

        $logo_escola = DB::table('escolas')
        ->select('logo_escola')
        ->where('nome_escola', $user->nome_escola)->first();

       foreach ($query as $funcionario) {
        $imagem_fun = $funcionario->imagem_fun;
            return view('PCA.ver_perfil2', ['logo_escola' => $logo_escola,'imagem_fun' => $imagem_fun,'user' => $user, 'funcionarios' => $funcionarios, 'funcionario' => $funcionario, 'logo_escola' => $logo_escola, 'pagina_anterior' => $pagina_anterior, 'rota' => $rota]);   

       }
       return view('PCA.ver_perfil2', ['logo_escola' => $logo_escola,'user' => $user, 'funcionarios' => $funcionarios, 'logo_escola' => $logo_escola, 'pagina_anterior' => $pagina_anterior, 'rota' => $rota]);   

    }

}
