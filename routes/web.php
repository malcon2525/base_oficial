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
Route::get('/usuarios/novo', [App\Http\Controllers\Adm\UserController::class, 'create'])->name('usuario.create');
Route::post('/usuarios', [App\Http\Controllers\Adm\UserController::class, 'store'])->name('usuario.store');
Route::get('/usuarios/{id}/editar', [App\Http\Controllers\Adm\UserController::class, 'edit'])->name('usuario.edit');
Route::put('/usuarios/{id}', [App\Http\Controllers\Adm\UserController::class, 'update'])->name('usuario.update');
Route::delete('/usuarios/{id}/excluir', [App\Http\Controllers\Adm\UserController::class, 'destroy'])->name('usuario.excluir');

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
