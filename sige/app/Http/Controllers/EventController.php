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

class EventController extends Controller
{
    public function index(){
        return view('webgenius');
    }

    public function index_register(){
        return redirect('/');
    }

    public function acessdenied(){
        return view('acessdenied');
    }


//background-color
public function background_color(Request $request){
    $user = auth()->user();
    $color_value = $request->cor;
    $r = $request->headers->get('referer');
    $pagina = substr($r, 22);
    User::where('id', $request->id)->update(['background_color' => $color_value]);
    return redirect()->back();
}
}
