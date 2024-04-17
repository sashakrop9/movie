<?php

namespace App\Http\Services;

use App\Models\User;

class MovieService
{
    public function getAllMoviesByUserId($userId)
    {
        $user = User::findOrFail($userId);
        return $user->movies;
    }
}
