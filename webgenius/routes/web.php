<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;
use App\Http\Controllers\AlunoController;
use App\Http\Controllers\PCAController;
use App\Http\Controllers\SecretariaController;
use App\Http\Controllers\TesourariaController;
use App\Http\Controllers\ProfessorController;




/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', [EventController::class, 'index']);
Route::get('/tesouraria', [TesourariaController::class, 'index'])->middleware('auth');
Route::get('/secretaria',[SecretariaController::class, 'index'])->middleware('auth');
Route::get('/professor',[ProfessorController::class, 'index'])->middleware('auth')->name('professor');
Route::get('/aluno', [AlunoController::class, 'index'])->middleware('auth');



//rotas pca
Route::get('/pcaadmin/cadasaluno', [PCAController::class, 'cadasaluno'])->middleware('auth')->name('cadasaluno');
Route::get('/pcaadmin', [PCAController::class, 'index'])->middleware('auth')->name('pcaadmin');
Route::post('/pcaadmin/cadasaluno', [PCAController::class, 'store_alunos'])->middleware('auth');

Route::get('/pcaadmin/funcionarios', [PCAController::class, 'cadafuncionario'])->middleware('auth')->name('funcionario');
Route::post('/pcaadmin', [PCAController::class, 'store_funcionarios'])->middleware('auth');

Route::get('/pcaadmin/permissoes', [PCAController::class, 'permissoes'])->middleware('auth')->name('permissoes');
Route::PUT('/pcaadmin', [PCAController::class, 'store_funcionarios'])->middleware('auth');





Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        $usuario = auth()->user();
        $permissao = $usuario->permissao;
    
        if ( (strcasecmp($permissao, "tesouraria")) == 0) {
            return redirect('/tesouraria');
        }elseif ( (strcasecmp($permissao, "secretaria")) == 0) {
            return redirect('/secretaria');
        }elseif ( (strcasecmp($permissao, "professor")) == 0) {
            return redirect('/professor');
        }elseif ( (strcasecmp($permissao, "sem")) == 0) {
            return redirect('/pcaadmin');
        }
    })->middleware('auth');
});
