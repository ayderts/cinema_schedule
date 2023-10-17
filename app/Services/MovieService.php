<?php


namespace App\Services;


use App\Models\Movie;
use Illuminate\Http\Request;


class MovieService
{
    public function indexView()
    {
        $movies = Movie::all();
        return view('admin.movies.index',compact('movies'));
    }

    public function showView(int $id)
    {
        $movie = Movie::find($id);
        return view('admin.movies.show',compact('movie'));
    }


    public function storeView()
    {
        return view('admin.movies.store');
    }

    public function updateView(int $id)
    {
        $movie = Movie::find($id);
        return view('admin.movies.update',compact('movie'));
    }

    public function destroy(int $id)
    {
        $movie = Movie::find($id);
        $movie->delete();
        return $this->indexView();
    }
}
