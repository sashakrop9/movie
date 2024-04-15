<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ApiMovieController;

Route::get('/movies/api', [ApiMovieController::class, 'index']);
