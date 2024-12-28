<?php

use App\Http\Controllers\AdmController;
use App\Http\Controllers\SiteController;
use Illuminate\Support\Facades\Route;

use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/', [SiteController::class, 'home']);
Route::get('/adm', [AdmController::class, 'index']);

// Route::get('/', function () {
//     return view('welcome');
// });

//CRUD USUARIOS
Route::get('/usuarios', [App\Http\Controllers\Adm\UserController::class, 'index'])->name('usuario.consulta');

Route::get('/usuarios/novo', [App\Http\Controllers\Adm\UserController::class, 'create'])->name('usuario.create');//apresenta o formulário de cadastro
Route::post('/usuarios', [App\Http\Controllers\Adm\UserController::class, 'store'])->name('usuario.store'); // recebe os dados do formulário e grava no banco

Route::get('/usuarios/{id}/editar', [App\Http\Controllers\Adm\UserController::class, 'edit'])->name('usuario.edit');//apresenta o formulário de edição
Route::put('/usuarios/{id}', [App\Http\Controllers\Adm\UserController::class, 'update'])->name('usuario.update');//recebe os dados para edição no banco


Route::get('/usuarios/{id}/excluir', [App\Http\Controllers\Adm\UserController::class, 'showDeleteForm'])->name('usuario.deleteForm');// Exibe a tela de confirmação para excluir
Route::delete('/usuarios/{id}/excluir', [App\Http\Controllers\Adm\UserController::class, 'destroy'])->name('usuario.excluir');// Exclui o usuário

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
