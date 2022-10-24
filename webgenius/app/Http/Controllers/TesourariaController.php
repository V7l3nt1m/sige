<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class TesourariaController extends Controller
{
    public function index(){
            $usuario = auth()->user();
            if($usuario->permissao === "tesouraria"){
                return view('tesouraria');
            }else{
                return view('acessdenied');
            }
    }
}
