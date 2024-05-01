<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\CreateMovieRequest;
use App\Http\Services\MovieService;
use App\Models\Movie;
use Illuminate\Http\Request;
use App\Http\Resources\MovieResource;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class MovieController extends Controller
{
    private MovieService $movieService;

    public function __construct(MovieService $movieService)
    {
        $this->middleware('auth:sanctum');
        $this->movieService = $movieService;
    }

    public function getAllMoviesByUserId($userId)
    {
        $movies = $this->movieService->getAllMoviesByUserId($userId);

        return response()->json($movies);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $movies = Movie::all(); // Получаем список фильмов с пагинацией

//        return response()->json($movies); // Возвращаем список фильмов в формате JSON
        return MovieResource::collection($movies);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateMovieRequest $request)
    {
        $validatedData = $request->validated();

        $user = Auth::user(); // Получаем текущего аутентифицированного пользователя

        $movie = new Movie();
        $movie->title = $request->title;
        $movie->description = $request->description;
        $movie->user_id = $user->id; // Связываем фильм с id пользователя

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/images', $imageName);
            $movie->image = 'storage/images/' . $imageName;
        }

        //привязка фильма к пользователю

        $user->movies()->save($movie);

        $movie->save();

        return new MovieResource($movie);
    }
    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $movie = Movie::findOrFail($id);
        return new MovieResource($movie);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $movie = Movie::findOrFail($id);
        $movie->delete();

        return response()->json(['message' => 'Movie deleted successfully']);
    }


}
