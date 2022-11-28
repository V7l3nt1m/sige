<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;

//PCA
use App\Http\Controllers\Pca\PCAController;
use App\Http\Controllers\Pca\PCADefController;
use App\Http\Controllers\Pca\PCADeleteController;
use App\Http\Controllers\Pca\PCAPerfilController;
use App\Http\Controllers\Pca\PCAStoreController;
use App\Http\Controllers\Pca\PCAUpdateController;

//SIGE
use App\Http\Controllers\Sige\SigeController;
use App\Http\Controllers\Sige\SigeDefController;
use App\Http\Controllers\Sige\SigeDeleteController;
use App\Http\Controllers\Sige\SigeStoreController;
use App\Http\Controllers\Sige\SigeUpdateController;

//Tesouraria
use App\Http\Controllers\Tesouraria\TesourariaController;
use App\Http\Controllers\Tesouraria\TesDefController;
use App\Http\Controllers\Tesouraria\TesDeleteController;
use App\Http\Controllers\Tesouraria\TesPerfilController;
use App\Http\Controllers\Tesouraria\TesStoreController;
use App\Http\Controllers\Tesouraria\TesUpdateController;

//Secretaria
use App\Http\Controllers\Secretaria\SecretariaController;
use App\Http\Controllers\Secretaria\SecreDefController;
use App\Http\Controllers\Secretaria\SecreDeleteController;
use App\Http\Controllers\Secretaria\SecrePerfilController;
use App\Http\Controllers\Secretaria\SecreStoreController;
use App\Http\Controllers\Secretaria\SecreUpdateController;

//Aluno
use App\Http\Controllers\Aluno\AlunoController;
use App\Http\Controllers\Aluno\AlunoDefController;
use App\Http\Controllers\Aluno\AlunoDeleteController;
use App\Http\Controllers\Aluno\AlunoPerfilController;
use App\Http\Controllers\Aluno\AlunoStoreController;
use App\Http\Controllers\Aluno\AlunoUpdateController;

//Aluno
use App\Http\Controllers\Professor\ProfessorController;
use App\Http\Controllers\Professor\ProfDefController;
use App\Http\Controllers\Professor\ProfDeleteController;
use App\Http\Controllers\Professor\ProfPerfilController;
use App\Http\Controllers\Professor\ProfStoreController;
use App\Http\Controllers\Professor\ProfUpdateController;






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
Route::post('/aluno', [AlunoController::class, 'login_aluno'])->middleware('aluno_denied');
Route::get('/sige', [SigeController::class, 'index'])->middleware('auth')->middleware('sige_denied');
Route::put('/cor/{id}', [EventController::class, 'background_color'])->middleware('auth');

//acess denied
Route::get('/acessdenied', [EventController::class, 'acessdenied'])->middleware('auth');

//Usuario acesso ao sistema

Route::get('/register', [EventController::class, 'index_register'])->middleware('auth')->name('register');

//Rotas Aluno/aluno
Route::put('/alunos/definições/{id}', [AlunoUpdateController::class, 'update_senha'])->middleware('auth')->middleware('aluno_denied');

//professor
Route::put('/professor/{id}', [ProfUpdateController::class, 'update_professor'])->middleware('auth')->middleware('professor_denied');

//rotas pcaaluno
Route::get('/pcaadmin/cadasaluno', [PCAController::class, 'cadasaluno'])->middleware('auth')->name('cadasaluno')->middleware('denied');
Route::post('/pcaadmin/cadasaluno', [PCAStoreController::class, 'store_alunos'])->middleware('auth')->middleware('denied');
Route::get('/pcaadmin/alunos', [PCAController::class, 'gerenciaralunos'])->middleware('auth')->middleware('denied')->name('gerenciaralunos');
Route::delete('/pcaadmin/alunos/{id}', [PCADeleteController::class, 'destroy_alunos'])->middleware('auth')->middleware('denied');

Route::get('/pcaadmin/edit/{id}', [PCAController::class, 'edit_alunos'])->middleware('auth')->middleware('denied');
Route::put('/pcaadmin/update_aluno/{id}', [PCAUpdateController::class, 'update_alunos'])->middleware('auth')->middleware('denied');

//rotas pcafuncionario
Route::get('/pcaadmin/funcionarios', [PCAController::class, 'cadafuncionario'])->middleware('auth')->name('funcionario')->middleware('denied');
Route::post('/pcaadmin/funcionarios', [PCAStoreController::class, 'store_funcionarios'])->middleware('auth')->middleware('denied');
Route::get('/pcaadmin/gerenfuncionarios', [PCAController::class, 'gerenciarfuncio'])->middleware('auth')->middleware('denied')->name('gerenciarfuncionarios');
Route::get('/pcaadmin/adicionarturma/{id}', [PCAController::class, 'adicionarturma'])->middleware('auth')->middleware('denied');
Route::post('/pcaadmin/adicionar/{id}', [PCAStoreController::class, 'adicionarturma_post'])->middleware('auth')->middleware('denied');
Route::delete('/pcaadmin/gerenfuncionarios/{id}', [PCADeleteController::class, 'destroy_funcionarios'])->middleware('auth')->middleware('denied');
Route::get('/pcaadmin/edit/{id}', [PCAController::class, 'edit_func'])->middleware('auth')->middleware('denied');
Route::put('/pcaadmin/update/{id}', [PCAUpdateController::class, 'update_func'])->middleware('auth')->middleware('denied');

Route::delete('/pcaadmin/edit/{id}', [PCADeleteController::class, 'delete_turm'])->middleware('auth')->middleware('denied');
Route::get('/pcaadmin/edit_turm/{id}', [PCAController::class, 'edit_turm_func'])->middleware('auth')->middleware('denied');
Route::put('/pcaadmin/update_tur_func/{id}', [PCAUpdateController::class, 'update_turm_func'])->middleware('auth')->middleware('denied');
//rota permissoes
Route::get('/pcaadmin/permissoes', [PCAController::class, 'permissoes'])->middleware('auth')->name('permissoes')->middleware('denied');
Route::put('/pcaadmin/permissoes/{id}', [PCAUpdateController::class, 'update_permissao'])->middleware('auth')->middleware('denied');

//rotas turmas
Route::get('/pcaadmin/turmas', [PCAController::class, 'turmas'])->middleware('auth')->name('turmas')->middleware('denied');
Route::post('/pcaadmin/turmas', [PCAStoreController::class, 'cadaturmas'])->middleware('auth')->middleware('denied');

Route::get('/pcaadmin/gerenciarturmas', [PCAController::class, 'gerenciarturmas'])->middleware('auth')->name('gerenciarturmas')->middleware('denied');
Route::post('/pcaadmin/gerenciarturmas', [PCAStoreController::class, 'associar_turmas'])->middleware('auth')->middleware('denied');


//rotas disciplinas
Route::get('/pcaadmin/disciplinas', [PCAController::class, 'disciplinas'])->middleware('auth')->name('disciplinas')->middleware('denied');
Route::post('/pcaadmin/disciplinas', [PCAStoreController::class, 'cadasdisciplinas'])->middleware('auth')->middleware('denied');

//rotas cursos
Route::get('/pcaadmin/cursos', [PCAController::class, 'cursos'])->middleware('auth')->name('cursos')->middleware('denied');
Route::post('/pcaadmin/cursos', [PCAStoreController::class, 'cadascursos'])->middleware('auth')->middleware('denied');

//rotas classes
Route::get('/pcaadmin/classes', [PCAController::class, 'classes'])->middleware('auth')->name('classes')->middleware('denied');
Route::post('/pcaadmin/classes', [PCAStoreController::class, 'cadaclasses'])->middleware('auth')->middleware('denied');


//rotas definicao
Route::get('/pcaadmin/definições', [PCAController::class, 'defi_admin'])->middleware('auth')->name('definicao')->middleware('denied');
Route::put('/pcaadmin/definições/{id}', [PCAUpdateController::class, 'updateinfo'])->middleware('auth')->middleware('denied');
Route::get('/pcaadmin/perfil', [PerfilController::class, 'perfil2'])->middleware('auth')->name('ver_perfil2')->middleware('denied');;


//rota perfil e definições
Route::get('/alunos/perfil', [AlunoPerfilController::class, 'perfil'])->middleware('auth')->name('perfil')->middleware('aluno_denied');
Route::get('/alunos/definições', [AlunoDefController::class, 'settings'])->middleware('auth')->name('settings')->middleware('aluno_denied');
//Nota alunos
Route::get('/aluno/timestreI', [AlunoController::class, 'timestreI'])->middleware('auth')->middleware('aluno_denied');
Route::get('/aluno/timestreII', [AlunoController::class, 'timestreII'])->middleware('auth')->middleware('aluno_denied');
Route::get('/aluno/timestreIII', [AlunoController::class, 'timestreIII'])->middleware('auth')->middleware('aluno_denied');
Route::get('/aluno/recurso', [AlunoController::class, 'recurso'])->middleware('auth')->middleware('aluno_denied');


Route::get('/secretaria/definições', [SecreDefController::class, 'defi_admin'])->middleware('auth')->middleware('secretaria_denied');
Route::get('/secretaria/perfil', [SecrePerfilController::class, 'perfil3'])->middleware('auth')->middleware('secretaria_denied');

Route::get('/tesouraria/definições', [TesDefController::class, 'defi_admin'])->middleware('auth')->middleware('tesouraria_denied');
Route::get('/tesouraria/perfil', [TesPerfilController::class, 'perfil4'])->middleware('auth')->middleware('tesouraria_denied');

//Professor rotas
Route::get('/professor/definições', [ProfDefController::class, 'settings_professor'])->middleware('auth')->middleware('professor_denied');
Route::get('/professor/perfil', [ProfPerfilController::class, 'perfil_professor'])->middleware('auth')->middleware('professor_denied');
Route::get('/professor/minhas_turmas', [ProfessorController::class, 'minhas_turmas'])->middleware('auth')->middleware('professor_denied');
Route::put('/professor/definições/{id}', [ProfUpdateController::class, 'update_professor'])->middleware('auth')->middleware('professor_denied');
Route::get('/professor/minhas_turmas', [ProfessorController::class, 'minhas_turmas'])->middleware('auth')->middleware('professor_denied');
 
//Lançamento de notas
Route::get('/professor/timestreI', [ProfessorController::class, 'timestreI'])->middleware('auth')->middleware('professor_denied');
Route::put('/professor/trimestreI/nota/{id}', [ProfUpdateController::class, 'nota_tri_I'])->middleware('auth')->middleware('professor_denied');

Route::get('/professor/timestreII', [ProfessorController::class, 'timestreII'])->middleware('auth')->middleware('professor_denied');
Route::put('/professor/trimestreII/nota/{id}', [ProfUpdateController::class, 'nota_tri_II'])->middleware('auth')->middleware('professor_denied');

Route::get('/professor/timestreIII', [ProfessorController::class, 'timestreIII'])->middleware('auth')->middleware('professor_denied');
Route::put('/professor/trimestreIII/nota/{id}', [ProfUpdateController::class, 'nota_tri_IIi'])->middleware('auth')->middleware('professor_denied');

Route::get('/professor/recurso', [ProfessorController::class, 'recurso'])->middleware('auth')->middleware('professor_denied');
Route::put('/professor/recurso/nota/{id}', [ProfUpdateController::class, 'recurso_nota'])->middleware('auth')->middleware('professor_denied');
//Escolas
Route::get('/sige/cadasescolas', [SigeController::class, 'cadasescolas'])->middleware('auth')->middleware('sige_denied');
Route::get('/sige/listaescolas', [SigeController::class, 'lista_escolas'])->middleware('auth')->middleware('sige_denied');
Route::post('/sige/cadasescolas', [SigeStoreController::class, 'store'])->middleware('auth')->middleware('sige_denied');
Route::delete('/sige/listaescolas/{id}', [SigeDeleteController::class, 'destroy_escola'])->middleware('auth')->middleware('sige_denied');
Route::get('/sige/edit_escola/{id}', [SigeController::class, 'edit_escola'])->middleware('auth')->middleware('sige_denied');
Route::put('/sige/update/{id}',[SigeUpdateController::class, 'update_escolas'])->middleware('auth')->middleware('sige_denied');

Route::get('/sige/definições', [SigeController::class, 'settings_sige'])->middleware('auth')->middleware('sige_denied');
Route::put('/sige/definições/{id}', [SigeDefController::class, 'update_sige'])->middleware('auth')->middleware('sige_denied');


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
        } elseif ( (strcasecmp($permissao, "sige")) == 0) {
            return redirect('/sige');
        }
        
    })->middleware('auth');
});
