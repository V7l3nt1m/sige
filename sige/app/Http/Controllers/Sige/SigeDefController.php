<?php

namespace App\Http\Controllers\Sige;

use Illuminate\Http\Request;
use App\Models\Escola;
use App\Models\User;
use App\Models\Funcionario;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
class SigeDefController extends Controller
{
    public function settings_sige(Request $request){
        $rota = \Request::route()->getName(); 
        session(['url.previous' => $request->url()]);
        $user = auth()->user();
        return view('defi_sige', ['user' => $user, 'rota' => $rota]);
    
    
    }
}
