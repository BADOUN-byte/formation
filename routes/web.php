<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\DirectionController;
use App\Http\Controllers\FormationController;
use App\Http\Controllers\AttestationController;
use App\Http\Controllers\FormationUserController;
use App\Http\Controllers\CommentController;

/*
|--------------------------------------------------------------------------
| Routes publiques (visiteur)
|--------------------------------------------------------------------------
*/
Route::get('/', [HomeController::class, 'index'])->name('welcome-route');

Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('login.store');

    // Uncomment if you want to enable registration
    // Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    // Route::post('/register', [RegisterController::class, 'register']);
});

/*
|--------------------------------------------------------------------------
| Déconnexion (authentifié)
|--------------------------------------------------------------------------
*/
Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth')->name('logout');

/*
|--------------------------------------------------------------------------
| Routes Authentifiées
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    // Tableau de bord
    Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard');
    Route::get('/home', fn () => redirect()->route('dashboard'))->name('home');

    // CRUD de base
    Route::resource('users', UserController::class);
    Route::resource('roles', RoleController::class);
    Route::resource('directions', DirectionController::class);
    Route::resource('formations', FormationController::class);

    // Attestations
    Route::get('/attestations', [AttestationController::class, 'index'])->name('attestations.index');
    Route::get('/attestations/create', [AttestationController::class, 'create'])->name('attestations.create');
    Route::post('/attestations', [AttestationController::class, 'store'])->name('attestations.store');

    // Formations par direction (route correcte)
    Route::get('/formations/direction/{direction}', [FormationController::class, 'indexParDirection'])->name('formations.direction.index');

    // Commentaires
    Route::get('/commentaires', [CommentController::class, 'index'])->name('commentaires.index');
    Route::post('/commentaires', [CommentController::class, 'store'])->name('commentaires.store');
    Route::delete('/commentaires/{comment}', [CommentController::class, 'destroy'])->name('commentaires.destroy');

    /*
    |--------------------------------------------------------------------------
    | Routes pour Admin uniquement
    |--------------------------------------------------------------------------
    */
    Route::middleware('can:admin')->group(function () {
        // Affectation formations aux utilisateurs
        Route::get('/users/{user}/formations/attach', [FormationUserController::class, 'attachForm'])->name('users.formations.attach.form');
        Route::post('/users/{user}/formations/attach', [FormationUserController::class, 'attach'])->name('users.formations.attach');
        Route::delete('/users/{user}/formations/detach', [FormationUserController::class, 'detach'])->name('users.formations.detach');

        // Édition formations attachées
        Route::get('/users/{user}/formations/{formation}/edit', [FormationUserController::class, 'edit'])->name('users.formations.edit');
        Route::put('/users/{user}/formations/{formation}', [FormationUserController::class, 'update'])->name('users.formations.update');
    });

    /*
    |--------------------------------------------------------------------------
    | Tableau de bord Admin (middleware spécifique is.admin)
    |--------------------------------------------------------------------------
    */
    Route::middleware('is.admin')->group(function () {
        Route::get('/admin/dashboard', fn () => view('admin.dashboard'))->name('admin.dashboard');
    });
});

/*
|--------------------------------------------------------------------------
| Route de test (facultative)
|--------------------------------------------------------------------------
*/
Route::get('/test', fn () => 'Test OK');
