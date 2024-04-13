<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    public function index()
    {
        $movies = Movie::paginate(10);
        return view('movies.index', compact('movies'));
    }

    public function create()
    {
        return view('movies.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('public/movies');
            $validatedData['image'] = str_replace('public/', 'storage/', $imagePath); // сохраняем путь без 'public/' в базу данных
        }

        Movie::create($validatedData);

        return redirect()->route('movies.index');
    }



    public function show(Movie $movie)
    {
        return view('movies.show', compact('movie'));
    }
}