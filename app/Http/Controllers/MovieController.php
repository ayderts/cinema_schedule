<?php

namespace App\Http\Controllers;

use App\Http\Requests\MovieStoreRequest;
use App\Http\Requests\MovieUpdateRequest;
use App\Models\Movie;
use App\Services\MovieService;
use Illuminate\Http\Request;
use Illuminate\View\View;
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
    public function indexView() : View
    {
      return $this->movieService->indexView();
    }

    /**
     * @param Movie $movie
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function showView(Movie $movie) : View
    {
        return $this->movieService->showView($movie);
    }

    /**
     * @param MovieStoreRequest $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function store(MovieStoreRequest $request) : View
    {
        return $this->movieService->store($request->validated());
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function storeView() : View
    {
        return $this->movieService->storeView();
    }

    /**
     * @param Movie $movie
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function updateView(Movie $movie) : View
    {
        return $this->movieService->updateView($movie);
    }

    /**
     * @param Movie $movie
     * @param MovieUpdateRequest $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function update(Movie $movie,MovieUpdateRequest $request) : View
    {
        return $this->movieService->update($movie,$request->validated());
    }

    /**
     * @param Movie $movie
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function destroy(Movie $movie) : View
    {
        return $this->movieService->destroy($movie);
    }
}
