<?php

namespace App\Http\Services;

use App\Models\User;

class MovieService
{
    public function getMoviesByUser($userId)
    {
        $user = User::findOrFail($userId);
        return $user->movies;
    }
}
