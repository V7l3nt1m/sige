<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Escola;
use App\Models\User;
use App\Models\Funcionario;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;


class SigeController extends Controller
{
    public function index(Request $request){
        $rota = \Request::route()->getName(); 
        $pagina_anterior = $request->headers->get('referer');
        $user = auth()->user();
        $logo_escola = DB::table('escolas')
        ->select('logo_escola')
        ->where('nome_escola', $user->nome_escola)->first();               
        
        return view('sige', ['user' => $user, 'pagina_anterior' => $pagina_anterior, 'logo_escola' => $logo_escola, 'rota' => $rota]);
    }

    
    public function cadasescolas(Request $request){
        $rota = \Request::route()->getName(); 
        session(['url.previous' => $request->url()]);
        $user = auth()->user();
        return view('cadastroescolas', ['user' => $user, 'rota' => $rota]);
    }

    //lista de escolas

    public function lista_escolas(Request $request){
        $rota = \Request::route()->getName(); 
        session(['url.previous' => $request->url()]);
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
        return view('lista_escolas', ['user' => $user, 'escolas' => $escolas, 'search' => $search, 'escolas2' => $escolas2, 'rota' => $rota]);
    
}

public function edit_escola($id, Request $request){
    session(['url.previous' => $request->url()]);
    $rota = \Request::route()->getName(); 
    $user = auth()->user();
  $escola = Escola::findOrFail($id);
        return view('edit_escola', ['user' => $user, 'escola' => $escola, 'rota' => $rota]);
}


}
