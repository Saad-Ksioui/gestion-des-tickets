<?php


use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\ProfileController;
use App\Http\Controllers\EmployeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;

Route::middleware('auth')->group(function () {
    //! Admin
    Route::middleware('admin')->group(function () {
        Route::get('/admin-dashboard', [AdminController::class, 'dashboard'])->name('admin-dashboard');

        //? User Management
        Route::get('/list-users', [AdminController::class, 'listUsers'])->name('list-users');
        Route::get('/create-user', [AdminController::class, 'createUser'])->name('create-user');
        Route::post('/store-user', [AdminController::class, 'storeUser'])->name('store-user');

        //? Statut Management
        Route::get('/list-statuts', [AdminController::class, 'listStatuts'])->name('list-statuts');
        Route::post('/store-statut', [AdminController::class, 'storeStatut'])->name('store-statut');
        Route::get('/edit-statut/{id}', [AdminController::class, 'editStatut'])->name('edit-statut');
        Route::put('/update-statut/{id}', [AdminController::class, 'updateStatut'])->name('update-statut');
        Route::delete('/delete-statut/{id}', [AdminController::class, 'deleteStatut'])->name('delete-statut');

        //? Priorite Management
        Route::get('/list-priorites', [AdminController::class, 'listPriorites'])->name('list-priorites');
        Route::post('/store-priorite', [AdminController::class, 'storePriorite'])->name('store-priorite');
        Route::get('/edit-priorite/{id}', [AdminController::class, 'editPriorite'])->name('edit-priorite');
        Route::put('/update-priorite/{id}', [AdminController::class, 'updatePriorite'])->name('update-priorite');
        Route::delete('/delete-priorite/{id}', [AdminController::class, 'deletePriorite'])->name('delete-priorite');

        //? Categorie Management
        Route::get('/list-categories', [AdminController::class, 'listCategories'])->name('list-categories');
        Route::post('/store-categorie', [AdminController::class, 'storeCategorie'])->name('store-categorie');
        Route::get('/edit-categorie/{id}', [AdminController::class, 'editCategorie'])->name('edit-categorie');
        Route::put('/update-categorie/{id}', [AdminController::class, 'updateCategorie'])->name('update-categorie');
        Route::delete('/delete-categorie/{id}', [AdminController::class, 'deleteCategorie'])->name('delete-categorie');

        //? Ticket Management
        Route::get('/list-tickets', [AdminController::class, 'listTickets'])->name('list-all-tickets');
        Route::get('/ticket/{id}', [AdminController::class, 'showTicket'])->name('show-ticket');
        Route::get('/edit-ticket/{id}', [AdminController::class, 'editTicket'])->name('edit-ticket');
        Route::put('/update-ticket/{id}', [AdminController::class, 'updateTicket'])->name('update-ticket');

        //? Comment Management
        Route::post('/store-comment/{id}', [AdminController::class, 'storeComment'])->name('store-comment');
        Route::delete('/delete-comment/{id}', [AdminController::class, 'deleteComment'])->name('delete-comment');
    });

    //! Employé
    Route::middleware('employe')->group(function () {
        Route::get('/employe-dashboard', [EmployeController::class, 'dashboard'])->name('employe-dashboard');
        Route::get('/list-tickets', [EmployeController::class, 'listTickets'])->name('employe-list-tickets');
        Route::post('/store-ticket', [EmployeController::class, 'storeTicket'])->name('store-ticket');
    });

    Route::get('/profile', [ProfileController::class, 'profile'])->name('profile');
    Route::put('/update-profile', [ProfileController::class, 'updateInfo'])->name('updateInfo');
    Route::put('/change-password', [ProfileController::class, 'changePassword'])->name('changePassword');
});

Route::get('/login', [AuthController::class, 'loginForm'])->name('login');
Route::post('/authenticate', [AuthController::class, 'login'])->name('authenticate');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('role.redirect')->group(function () {
    Route::get('/', function () {
        return redirect()->route('login');
    });
});