<?php

namespace App\Http\Controllers\Sige;

use Illuminate\Http\Request;
use App\Models\Escola;
use App\Models\User;
use App\Models\Funcionario;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;

class SigeDeleteController extends Controller
{
    public function destroy_escola($id){

        Escola::findOrFail($id)->delete();
    
        return redirect('/sige/listaescolas')->with('msg', 'Cadastro Eliminado com Sucesso!');
    }
    
}
