<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SecretariaController extends Controller
{
    public function index(){
        $usuario = auth()->user();
        if((strcasecmp($usuario->permissao, "secretaria")) == 0 || (strcasecmp($usuario->permissao, "pcaadmin")) == 0){
            return view('secretaria');
        }else{
            return redirect('acessdenied');
                }
}
}
