<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;
use App\Http\Controllers\AlunoController;
use App\Http\Controllers\PCAController;
use App\Http\Controllers\SecretariaController;
use App\Http\Controllers\TesourariaController;
use App\Http\Controllers\ProfessorController;
use App\Http\Controllers\SigeController;




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
Route::get('/tesouraria', [TesourariaController::class, 'index'])->middleware('auth')->middleware('tesouraria_denied');
Route::get('/secretaria',[SecretariaController::class, 'index'])->middleware('auth')->middleware('secretaria_denied');
Route::get('/professor',[ProfessorController::class, 'index'])->middleware('auth')->name('professor');
Route::get('/aluno', [AlunoController::class, 'index'])->middleware('auth')->middleware('auth')->middleware('aluno_denied');
Route::get('/pcaadmin', [PCAController::class, 'index'])->name('pcaadmin')->middleware('auth');
Route::get('/login_aluno', [AlunoController::class, 'login'])->name('login_aluno')->middleware('aluno_denied');
Route::post('/aluno', [AlunoController::class, 'login_aluno'])->middleware('aluno_denied');
Route::get('/sige', [SigeController::class, 'index'])->middleware('auth')->middleware('sige_denied');

//acess denied
Route::get('/acessdenied', [EventController::class, 'acessdenied'])->middleware('auth');


Route::get('/register', [EventController::class, 'index_register'])->middleware('auth')->name('register');

//Rotas Aluno/aluno
Route::put('/alunos/definições/{id}', [AlunoController::class, 'update_senha'])->middleware('auth')->middleware('aluno_denied');

//professor
Route::put('/professor/{id}', [ProfessorController::class, 'update_professor'])->middleware('auth')->middleware('professor_denied');

//rotas pcaaluno
Route::get('/pcaadmin/cadasaluno', [PCAController::class, 'cadasaluno'])->middleware('auth')->name('cadasaluno')->middleware('denied');
Route::post('/pcaadmin/cadasaluno', [PCAController::class, 'store_alunos'])->middleware('auth')->middleware('denied');
Route::get('/pcaadmin/alunos', [PCAController::class, 'gerenciaralunos'])->middleware('auth')->middleware('denied')->name('gerenciaralunos');
Route::delete('/pcaadmin/alunos/{id}', [PCAController::class, 'destroy_alunos'])->middleware('auth')->middleware('denied');

Route::get('/pcaadmin/edit/{id}', [PCAController::class, 'edit_alunos'])->middleware('auth')->middleware('denied');
Route::put('/pcaadmin/update_aluno/{id}', [PCAController::class, 'update_alunos'])->middleware('auth')->middleware('denied');

//rotas pcafuncionario
Route::get('/pcaadmin/funcionarios', [PCAController::class, 'cadafuncionario'])->middleware('auth')->name('funcionario')->middleware('denied');
Route::post('/pcaadmin/funcionarios', [PCAController::class, 'store_funcionarios'])->middleware('auth')->middleware('denied');
Route::get('/pcaadmin/gerenfuncionarios', [PCAController::class, 'gerenciarfuncio'])->middleware('auth')->middleware('denied')->name('gerenciarfuncionarios');
Route::get('/pcaadmin/adicionarturma/{id}', [PCAController::class, 'adicionarturma'])->middleware('auth')->middleware('denied');
Route::post('/pcaadmin/adicionar/{id}', [PCAController::class, 'adicionarturma_post'])->middleware('auth')->middleware('denied');
Route::delete('/pcaadmin/gerenfuncionarios/{id}', [PCAController::class, 'destroy_funcionarios'])->middleware('auth')->middleware('denied');
Route::get('/pcaadmin/edit/{id}', [PCAController::class, 'edit_func'])->middleware('auth')->middleware('denied');
Route::put('/pcaadmin/update/{id}', [PCAController::class, 'update_func'])->middleware('auth')->middleware('denied');

Route::delete('/pcaadmin/edit/{id}', [PCAController::class, 'delete_turm'])->middleware('auth')->middleware('denied');
Route::get('/pcaadmin/edit_turm/{id}', [PCAController::class, 'edit_turm_func'])->middleware('auth')->middleware('denied');
Route::put('/pcaadmin/update_tur_func/{id}', [PCAController::class, 'update_turm_func'])->middleware('auth')->middleware('denied');
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
Route::get('/pcaadmin/perfil', [PCAController::class, 'perfil2'])->middleware('auth')->name('ver_perfil2')->middleware('denied');;


//rota perfil e definições
Route::get('/alunos/perfil', [AlunoController::class, 'perfil'])->middleware('auth')->name('perfil')->middleware('aluno_denied');
Route::get('/alunos/definições', [AlunoController::class, 'settings'])->middleware('auth')->name('settings')->middleware('aluno_denied');


Route::get('/secretaria/definições', [SecretariaController::class, 'defi_admin'])->middleware('auth')->middleware('secretaria_denied');
Route::get('/secretaria/perfil', [SecretariaController::class, 'perfil3'])->middleware('auth')->middleware('secretaria_denied');

Route::get('/tesouraria/definições', [TesourariaController::class, 'defi_admin'])->middleware('auth')->middleware('tesouraria_denied');
Route::get('/tesouraria/perfil', [TesourariaController::class, 'perfil4'])->middleware('auth')->middleware('tesouraria_denied');

//Professor rotas
Route::get('/professor/definições', [ProfessorController::class, 'settings_professor'])->middleware('auth')->middleware('professor_denied');
Route::get('/professor/perfil', [ProfessorController::class, 'perfil_professor'])->middleware('auth')->middleware('professor_denied');
Route::get('/professor/minhas_turmas', [ProfessorController::class, 'minhas_turmas'])->middleware('auth')->middleware('professor_denied');
Route::put('/professor/definições/{id}', [ProfessorController::class, 'update_professor'])->middleware('auth')->middleware('professor_denied');
Route::get('/professor/minhas_turmas', [ProfessorController::class, 'minhas_turmas'])->middleware('auth')->middleware('professor_denied');


//Escolas
Route::get('/sige/cadasescolas', [SigeController::class, 'cadasescolas'])->middleware('auth')->middleware('sige_denied');
Route::get('/sige/listaescolas', [SigeController::class, 'lista_escolas'])->middleware('auth')->middleware('sige_denied');
Route::post('/sige/cadasescolas', [SigeController::class, 'store'])->middleware('auth')->middleware('sige_denied');
Route::delete('/sige/listaescolas/{id}', [SigeController::class, 'destroy_escola'])->middleware('auth')->middleware('sige_denied');
Route::get('/sige/edit_escola/{id}', [SigeController::class, 'edit_escola'])->middleware('auth')->middleware('sige_denied');
Route::put('/sige/update/{id}',[SigeController::class, 'update_escolas'])->middleware('auth')->middleware('sige_denied');

Route::get('/sige/definições', [SigeController::class, 'settings_sige'])->middleware('auth')->middleware('sige_denied');
Route::put('/sige/definições/{id}', [SigeController::class, 'update_sige'])->middleware('auth')->middleware('sige_denied');


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        $usuario = auth()->user();
        $permissao = $usuario->permissao;
    
        if ( (strcasecmp($permissao, "tesouraria")) == 0) {
            return redirect('/tesouraria/perfil');
        }elseif ( (strcasecmp($permissao, "secretaria")) == 0) {
            return redirect('/secretaria/perfil');
        }elseif ( (strcasecmp($permissao, "professor")) == 0) {
            return redirect('/professor/perfil');
        }elseif ( (strcasecmp($permissao, "Aluno")) == 0) {
            return redirect('/alunos/perfil');
        }
        elseif ( (strcasecmp($permissao, "pcaadmin")) == 0) {
            return redirect('/pcaadmin/perfil');
        } elseif ( (strcasecmp($permissao, "sige")) == 0) {
            return redirect('/sige');
        }
        
    })->middleware('auth');
});
