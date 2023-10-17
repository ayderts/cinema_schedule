<?php


namespace App\Services;


use App\Models\Movie;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;


class MovieService
{
    public function indexView()
    {
        $movies = Movie::all();
        return view('admin.movies.index',compact('movies'));
    }

    public function showView(Movie $movie)
    {
        return view('admin.movies.show',compact('movie'));
    }


    public function storeView()
    {
        return view('admin.movies.store');
    }

    public function updateView(Movie $movie)
    {
        return view('admin.movies.update',compact('movie'));
    }

    public function destroy(Model $movie)
    {
        $movie->delete();
        return $this->indexView();
    }
}
