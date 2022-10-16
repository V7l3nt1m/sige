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


Route::get('/',[EventController::class, 'index']);
Route::get('/tesouraria',[TesourariaController::class, 'index'])->middleware('auth');
Route::get('/secretaria',[SecretariaController::class, 'index'])->middleware('auth');
Route::get('/pcaadmin',[PCAController::class, 'index'])->middleware('auth');
Route::get('/professor',[ProfessorController::class, 'index'])->middleware('auth');
Route::get('/aluno',[AlunoController::class, 'index'])->middleware('auth');


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
