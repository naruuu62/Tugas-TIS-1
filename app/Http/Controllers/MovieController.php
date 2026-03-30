<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMovieRequest;
use App\Http\Requests\UpdateMovieRequest;
use App\Models\Movie;

class MovieController extends Controller
{
    public function createMovies(StoreMovieRequest $request)
    {
        $movie = Movie::create($request->validated());

        return response()->json($movie, 201);
    }

    public function getMovies()
    {
        return response()->json(Movie::all());
    }

    public function getMoviesById($id)
    {
        return response()->json(Movie::findOrFail($id));
    }

    public function updateMovies(UpdateMovieRequest $request, $id)
    {
        $movie = Movie::findOrFail($id);
        $movie->update($request->validated());

        return response()->json($movie);
    }

    public function deleteMovies($id)
    {
        Movie::destroy($id);

        return response()->json([
            'message' => 'Movie deleted'
        ]);
    }
}