<?php


use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;

Route::middleware('auth')->group(function () {
    Route::get('/', function(){
        return redirect('/admin-dashboard');
    });
    Route::get('/admin-dashboard', [AdminController::class, 'dashboard'])->name('admin-dashboard');
    Route::get('/list-users', [AdminController::class, 'listUsers'])->name('list-users');
    Route::get('/create-user', [AdminController::class, 'createUser'])->name('create-user');
    Route::post('/store-user', [AdminController::class, 'storeUser'])->name('store-user');
    Route::get('/list-statuts', [AdminController::class, 'listStatuts'])->name('list-statuts');
    Route::post('/store-statut', [AdminController::class, 'storeStatut'])->name('store-statut');
    Route::get('/edit-statut/{id}', [AdminController::class, 'editStatut'])->name('edit-statut');
    Route::put('/update-statut/{id}', [AdminController::class, 'updateStatut'])->name('update-statut');
    Route::delete('/delete-statut/{id}', [AdminController::class, 'deleteStatut'])->name('delete-statut');

    Route::get('/list-priorites', [AdminController::class, 'listPriorites'])->name('list-priorites');
    Route::post('/store-priorite', [AdminController::class, 'storePriorite'])->name('store-priorite');
    Route::get('/edit-priorite/{id}', [AdminController::class, 'editPriorite'])->name('edit-priorite');
    Route::put('/update-priorite/{id}', [AdminController::class, 'updatePriorite'])->name('update-priorite');
    Route::delete('/delete-priorite/{id}', [AdminController::class, 'deletePriorite'])->name('delete-priorite');
});

Route::get('/', function(){
    return redirect('/login');
});
Route::get('/login', [AuthController::class, 'loginForm'])->name('login');
Route::post('/authenticate', [AuthController::class, 'login'])->name('authenticate');
