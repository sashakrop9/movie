<?php
namespace App\Repositories;

use App\Models\Movie;

class MovieRepository
{
    public function getAllMoviesByUserId($userId)
    {
        return Movie::where('user_id', $userId)->get();
    }
}
