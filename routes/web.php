<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\DirectionController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\FormationController;
use App\Http\Controllers\FormationUserController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ReponseCommentaireController;
use App\Http\Controllers\AttestationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\NotificationController;

/*
|--------------------------------------------------------------------------
| Routes publiques (visiteurs)
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('welcome');
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('login.submit');
    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register'])->name('register.submit');
    Route::get('/password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
    Route::post('/password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
    Route::get('/password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
    Route::post('/password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');
});

/*
|--------------------------------------------------------------------------
| Déconnexion
|--------------------------------------------------------------------------
*/
Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth')->name('logout');

Route::get('/quitter-plateforme', function () {
    Auth::logout();
    return redirect()->route('welcome')->with('success', 'Vous avez quitté la plateforme.');
})->middleware('auth')->name('quitter-plateforme');

/*
|--------------------------------------------------------------------------
| Exploration publique
|--------------------------------------------------------------------------
*/
Route::get('/formations-public', [FormationController::class, 'index'])->name('formations.public.index');
Route::get('/public/formations/direction/{direction}', [FormationController::class, 'indexParDirection'])->name('formations.direction.index.public');
Route::get('/directions', [DirectionController::class, 'index'])->name('directions.liste');
Route::get('/directions/{direction}/detail', [DirectionController::class, 'detail'])->name('directions.detail');

/*
|--------------------------------------------------------------------------
| Utilisateurs connectés
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    // Accueil connecté
    Route::get('/home', [HomeController::class, 'home'])->name('home');
    Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard');

    // Profil
    Route::get('/profil', [ProfileController::class, 'show'])->name('profil.show');
    Route::get('/profil/edition', [ProfileController::class, 'edit'])->name('profil.edit');
    Route::put('/profil/edition', [ProfileController::class, 'update'])->name('profil.update');
    Route::get('/profil/password', [ProfileController::class, 'editPassword'])->name('profil.password.edit');
    Route::put('/profil/password', [ProfileController::class, 'updatePassword'])->name('profil.password.update');
    Route::delete('/profil/supprimer', [ProfileController::class, 'destroy'])->name('profil.delete');

    // Notifications
    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
    Route::post('/notifications/mark-as-read', [NotificationController::class, 'markAsRead'])->name('notifications.read');

    // Commentaires
    Route::resource('commentaires', CommentController::class)->except(['create', 'show']);
    Route::get('/commentaires/recherche', [CommentController::class, 'rechercher'])->name('commentaires.rechercher');
    Route::post('/commentaires/{commentaire}/reponses', [ReponseCommentaireController::class, 'store'])->name('reponses.store');
    Route::delete('/reponses/{reponse}', [ReponseCommentaireController::class, 'destroy'])->name('reponses.destroy');

    /*
    |--------------------------------------------------------------------------
    | ADMIN
    |--------------------------------------------------------------------------
    */
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [HomeController::class, 'Dashboard'])->name('dashboard');

        Route::resources([
            'users'      => UserController::class,
            'roles'      => RoleController::class,
            'directions' => DirectionController::class,
            'services'   => ServiceController::class,
            'formations' => FormationController::class,
        ]);

        Route::post('/users/{user}/toggle', [UserController::class, 'toggle'])->name('users.toggle');
        Route::get('/direction/{direction}/stats', [HomeController::class, 'directionStats'])->name('direction.stats');
        Route::get('/statistiques', [HomeController::class, 'globalStats'])->name('statistiques.global');
        Route::get('/statistiques/direction/{direction}', [HomeController::class, 'directionStats'])->name('statistiques.direction');
        Route::get('/formations/{formation}/participants', [FormationController::class, 'participants'])->name('formations.participants.index');
        Route::get('/formations/{formation}/participants/ajouter', [FormationController::class, 'ajouterParticipantForm'])->name('formations.participants.add');
        Route::post('/formations/{formation}/participants/ajouter', [FormationController::class, 'ajouterParticipant'])->name('formations.participants.store');
        Route::get('/formations/{formation}/export-participants', [FormationController::class, 'exportParticipants'])->name('formations.export.participants');

        Route::get('/attestations/direction/{direction}/download', [AttestationController::class, 'downloadGlobal'])->name('attestations.direction.download');

        Route::get('/formations/{formation}/documents', [FormationController::class, 'documents'])->name('formations.documents');
        Route::post('/formations/{formation}/documents', [FormationController::class, 'uploadDocument'])->name('formations.documents.upload');
        Route::delete('/formations/documents/{document}', [FormationController::class, 'deleteDocument'])->name('formations.documents.delete');

        Route::post('/formations/{formation}/dupliquer', [FormationController::class, 'dupliquer'])->name('formations.duplicate');
        Route::delete('/formations/expirees', [FormationController::class, 'supprimerExpirees'])->name('formations.expirees.delete');
        Route::get('/formations/export', [FormationController::class, 'export'])->name('formations.export');

        Route::get('/users/export', [UserController::class, 'export'])->name('users.export');

        Route::get('/users/{user}/formations/attach', [FormationUserController::class, 'attachForm'])->name('users.formations.attach.form');
        Route::post('/users/{user}/formations/attach', [FormationUserController::class, 'attach'])->name('users.formations.attach');
        Route::delete('/users/{user}/formations/detach', [FormationUserController::class, 'detach'])->name('users.formations.detach');
        Route::get('/users/{user}/formations/{formation}/edit', [FormationUserController::class, 'edit'])->name('users.formations.edit');
        Route::put('/users/{user}/formations/{formation}', [FormationUserController::class, 'update'])->name('users.formations.update');

        Route::get('/services/direction/{direction}', [ServiceController::class, 'indexParDirection'])->name('services.direction');
    });

    /*
    |--------------------------------------------------------------------------
    | FORMATEUR
    |--------------------------------------------------------------------------
    */
    Route::prefix('formateur')->name('formateur.')->group(function () {
        Route::get('/formations', [FormationController::class, 'mesFormations'])->name('formations.index');
        Route::get('/formations/{formation}', [FormationController::class, 'show'])->name('formations.show');
        Route::get('/formations/{formation}/participants', [FormationController::class, 'participants'])->name('formations.participants');
        Route::get('/formations/{formation}/documents', [FormationController::class, 'documents'])->name('formations.documents');
        Route::get('/formations/{formation}/attestations/{user}/download', [AttestationController::class, 'downloadIndividual'])->name('formations.attestations.download');

        Route::get('/formations/{formation}/commentaires', [CommentController::class, 'index'])->name('formations.commentaires.index');
        Route::post('/formations/{formation}/commentaires', [CommentController::class, 'store'])->name('formations.commentaires.store');
    });

    /*
    |--------------------------------------------------------------------------
    | PARTICIPANT
    |--------------------------------------------------------------------------
    */
    Route::prefix('participant')->name('participant.')->group(function () {
        Route::get('/formations', [FormationController::class, 'listePourParticipants'])->name('formations.index');
        Route::get('/formations/direction/{direction}', [FormationController::class, 'indexParDirection'])->name('formations.direction.index');
        Route::get('/formations/service/{service}', [FormationController::class, 'indexParService'])->name('formations.service.index');
        Route::get('/formations/{formation}', [FormationController::class, 'show'])->name('formations.show');
        Route::post('/formations/{formation}/inscription', [FormationController::class, 'inscrire'])->name('formations.inscrire');


        Route::get('/attestations', [AttestationController::class, 'index'])->name('attestations.index');
        Route::get('/formations/{formation}/attestation', [AttestationController::class, 'downloadIndividualParticipant'])->name('attestation.download');

        Route::post('/formations/{formation}/commentaires', [CommentController::class, 'store'])->name('formations.commentaires.store');
    });
});

/*
|--------------------------------------------------------------------------
| Fallback et test
|--------------------------------------------------------------------------
*/
Route::fallback(function () {
    return redirect()->route('welcome')->with('error', 'Page non trouvée.');
});

Route::get('/test', fn () => 'Test OK')->name('test');
