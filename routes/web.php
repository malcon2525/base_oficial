<?php

use App\Http\Controllers\Adm\PermissionController;
use App\Http\Controllers\Adm\RoleController;
use App\Http\Controllers\Adm\UserController;
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

// Adicione um grupo de rotas com o prefixo "adm"
Route::prefix('adm')->group(function () {
  Auth::routes(); // Registra as rotas de autenticação com o prefixo /adm
});

Route::get('/', [SiteController::class, 'home']);
Route::get('/adm', [AdmController::class, 'index']);

// Route::get('/', function () {
//     return view('welcome');
// });

//CRUD USUARIOS
Route::prefix('adm')->middleware(['auth', 'active'])->group(function () {
    Route::get('/usuarios', [App\Http\Controllers\Adm\UserController::class, 'index'])->name('usuario.consulta');

    Route::get('/usuarios/novo', [App\Http\Controllers\Adm\UserController::class, 'create'])->name('usuario.create');//apresenta o formulário de cadastro
    Route::post('/usuarios', [App\Http\Controllers\Adm\UserController::class, 'store'])->name('usuario.store'); // recebe os dados do formulário e grava no banco

    Route::get('/usuarios/{id}/editar', [App\Http\Controllers\Adm\UserController::class, 'edit'])->name('usuario.edit');//apresenta o formulário de edição
    Route::put('/usuarios/{id}', [App\Http\Controllers\Adm\UserController::class, 'update'])->name('usuario.update');//recebe os dados para edição no banco

    Route::get('/usuarios/{id}/excluir', [App\Http\Controllers\Adm\UserController::class, 'showDeleteForm'])->name('usuario.deleteForm');// Exibe a tela de confirmação para excluir
    Route::delete('/usuarios/{id}/excluir', [App\Http\Controllers\Adm\UserController::class, 'destroy'])->name('usuario.excluir');// Exclui o usuário

});
  
  
//rotas que assosiam papeis e permissões aos usuários
  Route::prefix('adm')->middleware(['auth', 'active'])->group(function () {
    Route::get('usuarios/{user}/papeis', [UserController::class, 'editRoles'])->name('users.roles.edit'); // irá exibir a página onde os papéis podem ser selecionados para o usuário.
    Route::post('usuarios/{user}/papeis', [UserController::class, 'updateRoles'])->name('users.roles.update'); //vai processar os dados do formulário e atualizar os papéis associados ao usuário.
    Route::get('usuarios/{user}/permissoes', [UserController::class, 'editPermissions'])->name('users.permissions.edit'); // irá exibir a página onde os papéis podem ser selecionados para o usuário.
    Route::post('usuarios/{user}/permissoes', [UserController::class, 'updatePermissions'])->name('users.permissions.update'); //vai processar os dados do formulário e atualizar os papéis associados ao usuário.

    Route::get('usuarios/{user}/papeis-permissoes', [UserController::class, 'rolesPermissionsSummary'])->name('users.roles.permissions.summary');

  });


//Rotas para crud de papeis.
Route::prefix('adm')->middleware(['auth', 'active'])->group(function () {
  
  // Rota para listar os papéis
  Route::get('papeis', [RoleController::class, 'index'])->name('roles.index');

  // Rota para exibir o formulário de criação de novo papel
  Route::get('papeis/novo', [RoleController::class, 'create'])->name('roles.create');

  // Rota para armazenar um novo papel
  Route::post('papeis', [RoleController::class, 'store'])->name('roles.store');

  // Rota para exibir o formulário de edição de um papel existente
  Route::get('papeis/{role}/editar', [RoleController::class, 'edit'])->name('roles.edit');

  // Rota para atualizar um papel existente
  Route::put('papeis/{role}', [RoleController::class, 'update'])->name('roles.update');

  // Rota para excluir um papel
  Route::delete('papeis/{role}', [RoleController::class, 'destroy'])->name('roles.destroy');

  // Rotas para gerenciar permissões de um papel
  Route::get('papeis/{role}/permissoes', [RoleController::class, 'permissions'])->name('roles.permissions');
  Route::post('papeis/{role}/permissoes', [RoleController::class, 'updatePermissions'])->name('roles.permissions.update');
});


//Rotas para CRUD de permissões
Route::prefix('adm')->middleware(['auth', 'active'])->group(function () {
  Route::get('permissoes', [PermissionController::class, 'index'])->name('permissions.index');
  Route::get('permissoes/novo', [PermissionController::class, 'create'])->name('permissions.create');
  Route::post('permissoes', [PermissionController::class, 'store'])->name('permissions.store');
  Route::get('permissoes/{permission}/editar', [PermissionController::class, 'edit'])->name('permissions.edit');
  Route::put('permissoes/{permission}', [PermissionController::class, 'update'])->name('permissions.update');
  Route::delete('permissoes/{permission}', [PermissionController::class, 'destroy'])->name('permissions.destroy');
});