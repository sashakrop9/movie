<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MovieController;

Route::get('/movies', [MovieController::class, 'index'])->name('movies.index');
Route::get('/movies/create', [MovieController::class, 'create'])->name('movies.create');
Route::post('/movies', [MovieController::class, 'store'])->name('movies.store');
Route::get('/movies/{movie}', [MovieController::class, 'show'])->name('movies.show');
