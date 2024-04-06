<?php


use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;

Route::middleware('auth')->group(function () {
    Route::get('/', [AdminController::class, 'dashboard'])->name('admin-dashboard');
    Route::get('/admin-dashboard', [AdminController::class, 'dashboard'])->name('admin-dashboard');
    Route::get('/create-user', [AdminController::class, 'createUser'])->name('create-user');
    Route::post('/store-user', [AdminController::class, 'storeUser'])->name('store-user');
    Route::get('/list-user', [AdminController::class, 'listUsers'])->name('list-users');
});

Route::get('/', [AuthController::class, 'loginForm'])->name('se-connecter');
Route::get('/se-connecter', [AuthController::class, 'loginForm'])->name('se-connecter');
Route::post('/login', [AuthController::class, 'login'])->name('login');
