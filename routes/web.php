<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    FilmController,
};

Route::get('/', [FilmController::class, 'movieHome'])->name('home');
Route::get('/movies', [FilmController::class, 'movies'])->name('movies');
Route::get('/movies/search', [FilmController::class, 'search'])->name('movies.search');
Route::post('/movies/{film}/comments', [\App\Http\Controllers\KritikController::class, 'store'])
    ->middleware('auth')
    ->name('movies.comments.store');
Route::get('/movies/{film}', [FilmController::class, 'show'])->name('movies.show');
Route::get('/movies/genre/{genre}', [FilmController::class, 'moviesByGenre'])->name('genre');

// Auth
Route::get('/login', [\App\Http\Controllers\Auth\AuthController::class, 'showLogin'])->name('login');
Route::post('/register', [\App\Http\Controllers\Auth\AuthController::class, 'register'])->name('register');
Route::post('/login', [\App\Http\Controllers\Auth\AuthController::class, 'login'])->name('login');
Route::post('/logout', [\App\Http\Controllers\Auth\AuthController::class, 'logout'])->name('logout');

// Admin dashboard & CRUD (hanya role admin)
Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/', [\App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');

    Route::resource('films', \App\Http\Controllers\Admin\FilmController::class);
    Route::resource('genres', \App\Http\Controllers\Admin\GenreController::class);
    Route::resource('casts', \App\Http\Controllers\Admin\CastController::class);
    Route::resource('perans', \App\Http\Controllers\Admin\PeranController::class);
    Route::resource('kritiks', \App\Http\Controllers\Admin\KritikController::class)->only(['index', 'destroy']);
    Route::resource('users', \App\Http\Controllers\Admin\UserController::class)->except(['create', 'store', 'show']);
});
