<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\ArticleController;
use \App\Http\Controllers\CustomAuthController;
use \App\Http\Controllers\LocalizationController;
use \App\Http\Controllers\EtudiantController;
use \App\Http\Controllers\VilleController;
use \App\Http\Controllers\DocController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('login', [CustomAuthController::class, 'index'])->name('login');
Route::post('custom-login', [CustomAuthController::class, 'customLogin'])->name('custom.login');
Route::get('registration', [CustomAuthController::class, 'create'])->name('registration');;
Route::post('custom-registration', [CustomAuthController::class, 'store'])->name('custom.registration');

Route::get('/lang/{locale}', [LocalizationController::class, 'index'])->name('lang');

Route::group(['middleware' => ['auth']], function () {
    Route::get('logout', [CustomAuthController::class, 'logout'])->name('logout');
    Route::get('dashboard', [CustomAuthController::class, 'showStudent'])->name('dashboard');

    Route::get('/forum', [ArticleController::class, 'index'])->name('forum');
    Route::get('/forum/{article}', [ArticleController::class, 'show'])->name('forum.show');
    Route::get('/forum/create/post', [ArticleController::class, 'create'])->name('forum.create');
    Route::post('/forum/create/post', [ArticleController::class, 'store'])->name('forum.store');
    Route::get('forum/{article}/edit', [ArticleController::class, 'edit'])->name('forum.edit');
    Route::put('forum/{article}/edit', [ArticleController::class, 'update']);
    Route::delete('forum/{article}', [ArticleController::class, 'destroy']);
    Route::get('forum-queries', [ArticleController::class, 'queries']);
    Route::get('forum/{article}/PDF', [ArticleController::class, 'showPdf'])->name('forum.pdf');

    Route::get('/ville', [VilleController::class, 'index'])->name('ville');
    Route::get('/ville/{ville}', [VilleController::class, 'show'])->name('ville.show');

    Route::get('/etudiant', [EtudiantController::class, 'index'])->name('etudiant');
    Route::get('/etudiant/{etudiant}', [EtudiantController::class, 'show'])->name('etudiant.show');
    Route::get('/etudiant/create/post', [EtudiantController::class, 'create'])->name('etudiant.create');
    Route::post('/etudiant/create/post', [EtudiantController::class, 'store'])->name('etudiant.store');
    Route::get('/etudiant/{etudiant}/edit', [EtudiantController::class, 'edit'])->name('etudiant.edit');
    Route::put('/etudiant/{etudiant}/edit', [EtudiantController::class, 'update'])->name('etudiant.update');
    Route::delete('/etudiant/{etudiant}', [EtudiantController::class, 'destroy'])->name('etudiant.destroy');

    Route::get('/doc', [DocController::class, 'index'])->name('doc');
    Route::get('/doc/{doc}', [DocController::class, 'show'])->name('doc.show');
    Route::get('/upload', [DocController::class, 'create'])->name('doc.create');
    Route::post('/doc/select', [DocController::class, 'store'])->name('doc.store');
    Route::get('/doc/{doc}/edit', [DocController::class, 'edit'])->name('doc.edit');
    Route::put('/doc/{doc}/edit', [DocController::class, 'update'])->name('doc.update');
    Route::delete('/doc/{doc}', [DocController::class, 'destroy'])->name('doc.destroy');
});
