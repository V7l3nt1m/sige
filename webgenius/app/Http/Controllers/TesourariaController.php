<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class TesourariaController extends Controller
{
    public function index(){
            $usuario = auth()->user();
            if((strcasecmp($usuario->permissao, "tesouraria")) == 0 || (strcasecmp($usuario->permissao, "pcaadmin")) == 0){
                return view('tesouraria');
            }else{
                return redirect('acessdenied');
                        }
    }
}
