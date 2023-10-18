<?php


namespace App\Services;


use App\Models\Movie;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\View\View;


class MovieService
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function indexView() : View
    {
        $movies = Movie::all();
        return view('admin.movies.index',compact('movies'));
    }

    /**
     * @param Movie $movie
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function showView(Movie $movie) : View
    {
        return view('admin.movies.show',compact('movie'));
    }

    public function store(array $request) : View
    {
        $image = $request['image'];
        unset($request['image']);
        $movie = Movie::create($request);
        $imageName = $movie->id . '.' . $image->getClientOriginalExtension();
        $movie->update(['image' => $imageName]);
        $image->move(public_path('images'), $imageName);
        return $this->indexView();
    }
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function storeView() : View
    {
        return view('admin.movies.store');
    }

    public function update(Movie $movie, array $request) : View
    {

        $data = collect($request)->filter(function ($value) {
            return !is_null($value) && $value !== '';
        })->all();

        if (array_key_exists('image', $data)) {
            $image = $data['image'];
            $imageName = $movie->id . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
            $data['image'] = $imageName;
        }

        $movie->update($data);

        return view('admin.movies.show', compact('movie'));
    }
    /**
     * @param Movie $movie
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function updateView(Movie $movie) : View
    {
        return view('admin.movies.update',compact('movie'));
    }

    /**
     * @param Model $movie
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function destroy(Model $movie) : View
    {
        $movie->delete();
        return $this->indexView();
    }
}
