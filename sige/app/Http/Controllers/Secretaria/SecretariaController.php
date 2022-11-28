<?php

namespace App\Http\Controllers\Secretaria;

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


class SecretariaController extends Controller
{
    public function index(){
        $user = auth()->user();
        $pagina_anterior = $request->headers->get('referer');
        $rota = \Request::route()->getName(); 
        return view('secretaria', ['user' => $user, 'rota' => $rota, 'pagina_anterior' => $pagina_anterior]);
}

    

}