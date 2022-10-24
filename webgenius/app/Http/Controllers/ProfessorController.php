<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfessorController extends Controller
{
    public function index(){
        $usuario = auth()->user();
        if($usuario->permissao === "professor"){
            return view('professor');
        }else{
            return view('acessdenied');
        }
}
}
