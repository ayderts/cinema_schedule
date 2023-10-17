<?php

namespace App\Http\Controllers;

use App\Http\Requests\MovieStoreRequest;
use App\Http\Requests\MovieUpdateRequest;
use App\Models\Movie;
use App\Services\MovieService;
use Illuminate\Http\Request;
use phpseclib3\File\ASN1\Maps\PostalAddress;

class MovieController extends Controller
{

    protected MovieService $movieService;

    public function __construct( MovieService $movieService)
    {
        $this->movieService = $movieService;
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function indexView()
    {
      return $this->movieService->indexView();
    }

    /**
     * @param Movie $movie
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function showView(Movie $movie)
    {
        return $this->movieService->showView($movie);
    }

    /**
     * @param MovieStoreRequest $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function store(MovieStoreRequest $request)
    {
        $movie = Movie::create($request->except('image'));
        $image = $request->file('image');
        $imageName = $movie->id . '.' . $image->getClientOriginalExtension();
        $movie->update(['image' => $imageName]);
        $image->move(public_path('images'), $imageName);
        return $this->indexView();
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function storeView()
    {
        return $this->movieService->storeView();
    }

    /**
     * @param Movie $movie
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function updateView(Movie $movie)
    {
        return $this->movieService->updateView($movie);
    }

    /**
     * @param Movie $movie
     * @param MovieUpdateRequest $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function update(Movie $movie,MovieUpdateRequest $request)
    {
        $data = $request->validated();
        $data = array_filter($data, function ($value) {
            return !is_null($value) && $value !== '';
        });
        $movie->fill($data);
        if($request->has('image')){
            $image = $data['image'];
            unset($data['image']);
            $imageName = $movie->id . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
            $movie->image = $imageName;
        }

        $movie->save();
        return view('admin.movies.show',compact('movie'));
    }

    /**
     * @param Movie $movie
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function destroy(Movie $movie)
    {
        return $this->movieService->destroy($movie);
    }
}
