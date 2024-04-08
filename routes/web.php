<?php


use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;

Route::middleware('auth')->group(function () {
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

    Route::get('/list-categories', [AdminController::class, 'listCategories'])->name('list-categories');
    Route::post('/store-categorie', [AdminController::class, 'storeCategorie'])->name('store-categorie');
    Route::get('/edit-categorie/{id}', [AdminController::class, 'editCategorie'])->name('edit-categorie');
    Route::put('/update-categorie/{id}', [AdminController::class, 'updateCategorie'])->name('update-categorie');
    Route::delete('/delete-categorie/{id}', [AdminController::class, 'deleteCategorie'])->name('delete-categorie');

    Route::get('/list-tickets', [AdminController::class, 'listTickets'])->name('list-tickets');
    Route::get('/ticket/{id}', [AdminController::class, 'showTicket'])->name('show-ticket');
    Route::post('/store-comment/{id}', [AdminController::class, 'storeComment'])->name('store-comment');
    Route::delete('/delete-comment/{id}', [AdminController::class, 'deleteComment'])->name('delete-comment');

    Route::get('/profile', [ProfileController::class, 'profile'])->name('profile');
    Route::put('/update-profile', [ProfileController::class, 'updateInfo'])->name('updateInfo');
    Route::put('/change-password', [ProfileController::class, 'changePassword'])->name('changePassword');
});

Route::get('/', function () {
    if (auth()->check()) {
        switch (auth()->user()->role_id) {
            case 1:
                return redirect('/admin-dashboard');
            case 2:
                return redirect('/technicien-dashboard');
            case 3:
                return redirect('/employee-dashboard');
            default:
                break;
        }
    } else {
        return redirect('/login');
    }

});
Route::get('/login', [AuthController::class, 'loginForm'])->name('login');
Route::post('/authenticate', [AuthController::class, 'login'])->name('authenticate');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
