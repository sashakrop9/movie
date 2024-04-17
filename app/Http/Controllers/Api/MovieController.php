<?php

namespace App\Http\Controllers\Api;

use App\Models\Movie;
use Illuminate\Http\Request;
use App\Http\Resources\MovieResource;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class MovieController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
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
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user = Auth::user(); // Получаем текущего аутентифицированного пользователя

        $movie = new Movie();
        $movie->title = $request->title;
        $movie->description = $request->description;
        $movie->user_name = $user->name; // Связываем фильм с именем пользователем
        $movie->user_id = $user->id;

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
