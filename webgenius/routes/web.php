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
Route::get('/pcaadmin', [PCAController::class, 'index'])->name('pcaadmin');
Route::get('/login_aluno', [AlunoController::class, 'login'])->name('login_aluno');
Route::post('/aluno', [AlunoController::class, 'login_aluno']);



Route::get('/register', [EventController::class, 'register'])->name('register');
//Rotas Aluno/aluno
Route::put('/aluno/{id}', [AlunoController::class, 'update_senha'])->middleware('auth');



//rotas pcaaluno
Route::get('/pcaadmin/cadasaluno', [PCAController::class, 'cadasaluno'])->middleware('auth')->name('cadasaluno');
Route::post('/pcaadmin/cadasaluno', [PCAController::class, 'store_alunos'])->middleware('auth');
Route::get('/pcaadmin/alunos', [PCAController::class, 'gerenciaralunos'])->middleware('auth')->name('gerenciaralunos');


//rotas pcafuncionario
Route::get('/pcaadmin/funcionarios', [PCAController::class, 'cadafuncionario'])->middleware('auth')->name('funcionario');
Route::post('/pcaadmin/funcionarios', [PCAController::class, 'store_funcionarios'])->middleware('auth');

//rota permissoes
Route::get('/pcaadmin/permissoes', [PCAController::class, 'permissoes'])->middleware('auth')->name('permissoes');
Route::PUT('/pcaadmin', [PCAController::class, 'store_funcionarios'])->middleware('auth');

//rotas turmas
Route::get('/pcaadmin/turmas', [PCAController::class, 'turmas'])->middleware('auth')->name('turmas');
Route::post('/pcaadmin/turmas', [PCAController::class, 'cadaturmas'])->middleware('auth');
Route::get('/pcaadmin/gerenciarturmas', [PCAController::class, 'gerenciarturmas'])->middleware('auth')->name('gerenciarturmas');
Route::post('/pcaadmin/gerenciarturmas', [PCAController::class, 'associar_turmas'])->middleware('auth');


//rotas disciplinas
Route::get('/pcaadmin/disciplinas', [PCAController::class, 'disciplinas'])->middleware('auth')->name('disciplinas');
Route::post('/pcaadmin/disciplinas', [PCAController::class, 'cadasdisciplinas'])->middleware('auth');

//rotas cursos
Route::get('/pcaadmin/cursos', [PCAController::class, 'cursos'])->middleware('auth')->name('cursos');
Route::post('/pcaadmin/cursos', [PCAController::class, 'cadascursos'])->middleware('auth');

//rotas classes
Route::get('/pcaadmin/classes', [PCAController::class, 'classes'])->middleware('auth')->name('classes');
Route::post('/pcaadmin/classes', [PCAController::class, 'cadaclasses'])->middleware('auth');


//rotas definicao
Route::get('/pcaadmin/definições', [PCAController::class, 'definicao'])->middleware('auth')->name('definicao');
Route::put('/pcaadmin/definições/{id}', [PCAController::class, 'updateinfo'])->middleware('auth');


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
