<?php

namespace App\Http\Services;

use App\Repositories\MovieRepository;

class MovieService
{
    protected $movieRepository;

    public function __construct(MovieRepository $movieRepository)
    {
        $this->movieRepository = $movieRepository;
    }

    public function getAllMoviesByUserId($userId)
    {
        return $this->movieRepository->getAllMoviesByUserId($userId);
    }
}
