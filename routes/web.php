<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

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

    Route::get('/produtos', function () {
        return view('produtos.index');
    })->middleware('can:access produtos');

    Route::get('/categorias', function () {
        return view('categorias.index');
    })->middleware('can:access categ');

    Route::get('/marcas', function () {
        return view('marcas.index');
    })->middleware('can:access marcas');

    Route::get('/usuarios', function () {
        return view('usuarios.index');
    })->middleware('can:manage users');

    Route::get('/permissoes', function () {
        return view('permissoes.index');
    })->middleware('can:manage permissions');
});
