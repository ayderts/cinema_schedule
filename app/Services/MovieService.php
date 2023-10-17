<?php


namespace App\Services;


use App\Models\Movie;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;


class MovieService
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function indexView()
    {
        $movies = Movie::all();
        return view('admin.movies.index',compact('movies'));
    }

    /**
     * @param Movie $movie
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function showView(Movie $movie)
    {
        return view('admin.movies.show',compact('movie'));
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function storeView()
    {
        return view('admin.movies.store');
    }

    /**
     * @param Movie $movie
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function updateView(Movie $movie)
    {
        return view('admin.movies.update',compact('movie'));
    }

    /**
     * @param Model $movie
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function destroy(Model $movie)
    {
        $movie->delete();
        return $this->indexView();
    }
}
