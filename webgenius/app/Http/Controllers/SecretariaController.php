<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SecretariaController extends Controller
{
    public function index(){
        $usuario = auth()->user();
        if($usuario->permissao === "secretaria"){
            return view('secretaria');
        }else{
            return view('acessdenied');
        }
}
}
