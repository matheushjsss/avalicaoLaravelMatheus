<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PerfilController;
use App\Models\User;

// Redirecionamento da home
Route::get('/', function () {
    return Auth::check() ? redirect('/home') : view('auth.login');
});

// Rotas de autenticação
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

// Logout usando o controller
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Grupo de rotas protegidas por autenticação
Route::middleware(['auth'])->group(function () {

    //Acessos Usuarios
    Route::get('/home', function () {
        if (Auth::user()->hasRole('admin')) {
            return redirect('/admin');
        }else{
            return view('home');
        }
    });

    Route::get('/produtos', function () {
        return view('produtos');
    })->middleware('can:acesso produtos')->name('produtos');

    Route::get('/categorias', function () {
        return view('categorias');
    })->middleware('can:acesso categ')->name('categorias');

    Route::get('/marcas', function () {
        return view('marcas');
    })->middleware('can:acesso marcas')->name('marcas');
    

    // Acessos Admin
    Route::get('/admin', function () {
        return view('admin.home');
    })->middleware(['auth', 'can:admin'])->name('admin');

    Route::get('/admin/home', function () {
        return view('admin.home');
    })->middleware(['auth', 'can:admin'])->name('admin.home');

    Route::get('/admin/users', [UserController::class, 'index'])->middleware(['auth', 'can:admin'])->name('admin.users');
    Route::get('/admin/users/create', [UserController::class, 'create'])->middleware(['auth', 'can:admin'])->name('admin.users.create');
    Route::post('/admin/users', [UserController::class, 'create'])->middleware(['auth', 'can:admin'])->name('admin.users.creatpost');

    Route::get('/admin/users/{id}/perfis', [UserController::class, 'perfis'])->middleware(['auth', 'can:admin'])->name('admin.users.perfis');
    Route::get('/admin/users/{id}/perfis/adicionar', [UserController::class, 'adicionarPerfilshow'])->middleware(['auth', 'can:admin'])->name('admin.users.addperfis');
    Route::post('/admin/users/{id}/perfis/adicionar', [UserController::class, 'adicionarPerfil'])->middleware(['auth', 'can:admin'])->name('admin.users.addperfispost');
    Route::delete('/admin/users/{userId}/perfis/{id}', [UserController::class, 'removerPerfil'])->middleware(['auth', 'can:admin'])->name('admin.users.remover-perfil');

    Route::get('/admin/users/{id}/editar', function ($id) {
        return view('admin.users.edit', ['user' => User::findOrFail($id)]);
    })->middleware(['auth', 'can:admin'])->name('admin.users.editar');
    Route::put('/admin/users/{id}', [UserController::class, 'editar'])->name('admin.users.editarput');
    
    Route::delete('/admin/users/{id}', [UserController::class, 'destroy'])->middleware(['auth', 'can:admin'])->name('admin.users.excluir');

    //Acessos Perfis
    Route::get('/admin/perfis', [PerfilController::class, 'index'])->middleware(['auth', 'can:admin'])->name('admin.perfis');
    Route::get('/admin/perfis/{roleId}/editar', [PerfilController::class, 'editar'])->middleware(['auth', 'can:admin'])->name('admin.perfil.editar');
    Route::put('/admin/perfis/{id}', [PerfilController::class, 'atualizar'])->middleware(['auth', 'can:admin'])->name('admin.perfil.atualizar');
});
