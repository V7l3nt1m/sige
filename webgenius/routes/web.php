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
Route::get('/aluno', [AlunoController::class, 'index'])->middleware('auth')->middleware('auth');
Route::get('/pcaadmin', [PCAController::class, 'index'])->name('pcaadmin')->middleware('auth');
Route::get('/login_aluno', [AlunoController::class, 'login'])->name('login_aluno');
Route::post('/aluno', [AlunoController::class, 'login_aluno']);

//acess denied
Route::get('/acessdenied', [EventController::class, 'acessdenied'])->middleware('auth');


Route::get('/register', [EventController::class, 'index_register'])->middleware('auth')->name('register');

//Rotas Aluno/aluno
Route::put('/alunos/definições/{id}', [AlunoController::class, 'update_senha'])->middleware('auth');

//professor
Route::put('/professor/{id}', [ProfessorController::class, 'update_professor'])->middleware('auth');

//rotas pcaaluno
Route::get('/pcaadmin/cadasaluno', [PCAController::class, 'cadasaluno'])->middleware('auth')->name('cadasaluno')->middleware('denied');
Route::post('/pcaadmin/cadasaluno', [PCAController::class, 'store_alunos'])->middleware('auth')->middleware('denied');
Route::get('/pcaadmin/alunos', [PCAController::class, 'gerenciaralunos'])->middleware('auth')->middleware('denied')->name('gerenciaralunos');


//rotas pcafuncionario
Route::get('/pcaadmin/funcionarios', [PCAController::class, 'cadafuncionario'])->middleware('auth')->name('funcionario')->middleware('denied');
Route::post('/pcaadmin/funcionarios', [PCAController::class, 'store_funcionarios'])->middleware('auth')->middleware('denied');
Route::get('/pcaadmin/gerenfuncionarios', [PCAController::class, 'gerenciarfuncio'])->middleware('auth')->middleware('denied')->name('gerenciarfuncionarios');

//rota permissoes
Route::get('/pcaadmin/permissoes', [PCAController::class, 'permissoes'])->middleware('auth')->name('permissoes')->middleware('denied');
Route::put('/pcaadmin/permissoes/{id}', [PCAController::class, 'update_permissao'])->middleware('auth')->middleware('denied');
Route::PUT('/pcaadmin', [PCAController::class, 'store_funcionarios'])->middleware('auth')->middleware('denied');

//rotas turmas
Route::get('/pcaadmin/turmas', [PCAController::class, 'turmas'])->middleware('auth')->name('turmas')->middleware('denied');
Route::post('/pcaadmin/turmas', [PCAController::class, 'cadaturmas'])->middleware('auth')->middleware('denied');
Route::get('/pcaadmin/gerenciarturmas', [PCAController::class, 'gerenciarturmas'])->middleware('auth')->name('gerenciarturmas')->middleware('denied');
Route::post('/pcaadmin/gerenciarturmas', [PCAController::class, 'associar_turmas'])->middleware('auth')->middleware('denied');


//rotas disciplinas
Route::get('/pcaadmin/disciplinas', [PCAController::class, 'disciplinas'])->middleware('auth')->name('disciplinas')->middleware('denied');
Route::post('/pcaadmin/disciplinas', [PCAController::class, 'cadasdisciplinas'])->middleware('auth')->middleware('denied');

//rotas cursos
Route::get('/pcaadmin/cursos', [PCAController::class, 'cursos'])->middleware('auth')->name('cursos')->middleware('denied');
Route::post('/pcaadmin/cursos', [PCAController::class, 'cadascursos'])->middleware('auth')->middleware('denied');

//rotas classes
Route::get('/pcaadmin/classes', [PCAController::class, 'classes'])->middleware('auth')->name('classes')->middleware('denied');
Route::post('/pcaadmin/classes', [PCAController::class, 'cadaclasses'])->middleware('auth')->middleware('denied');


//rotas definicao
Route::get('/pcaadmin/definições', [PCAController::class, 'defi_admin'])->middleware('auth')->name('definicao')->middleware('denied');
Route::put('/pcaadmin/definições/{id}', [PCAController::class, 'updateinfo'])->middleware('auth')->middleware('denied');

//rota perfil e definições
Route::get('/alunos/perfil', [AlunoController::class, 'perfil'])->middleware('auth')->name('perfil');
Route::get('/pcaadmin/perfil', [PCAController::class, 'perfil2'])->middleware('auth')->name('ver_perfil2')->middleware('denied');;
Route::get('/alunos/definições', [AlunoController::class, 'settings'])->middleware('auth')->name('settings');


Route::get('/secretaria/definições', [SecretariaController::class, 'defi_admin'])->middleware('auth');
Route::get('/secretaria/perfil', [SecretariaController::class, 'perfil3'])->middleware('auth');

Route::get('/tesouraria/definições', [TesourariaController::class, 'defi_admin'])->middleware('auth');
Route::get('/tesouraria/perfil', [TesourariaController::class, 'perfil4'])->middleware('auth');

//Professor rotas
Route::get('/professor/definições', [ProfessorController::class, 'settings_professor'])->middleware('auth');
Route::get('/professor/perfil', [ProfessorController::class, 'perfil_professor'])->middleware('auth');
Route::get('/professor/minhas_turmas', [ProfessorController::class, 'minhas_turmas'])->middleware('auth');
Route::put('/professor/definições/{id}', [ProfessorController::class, 'update_professor'])->middleware('auth');



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
        }elseif ( (strcasecmp($permissao, "Aluno")) == 0) {
            return redirect('/aluno');
        }
        elseif ( (strcasecmp($permissao, "pcaadmin")) == 0) {
            return redirect('/pcaadmin');
        }
        
    })->middleware('auth');
});
