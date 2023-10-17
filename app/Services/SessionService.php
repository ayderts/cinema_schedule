<?php


namespace App\Services;


use App\Models\Movie;
use App\Models\Session;

class SessionService
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function indexView()
    {
        $sessions = Session::with('movie')->get();
        return view('admin.sessions.index',compact('sessions'));
    }

    /**
     * @param Session $session
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function showView(Session $session)
    {
        return view('admin.sessions.show',compact('session'));
    }

    /**
     * @param array $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function store(array $request)
    {
        $session = Session::create($request);
        return $this->indexView();
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function storeView()
    {
        $movies = Movie::all();
        return view('admin.sessions.store',compact('movies'));
    }

    /**
     * @param Session $session
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function updateView(Session $session)
    {
        $movies = Movie::all();
        return view('admin.sessions.update',compact('session','movies'));
    }

    /**
     * @param Session $session
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function destroy(Session $session){
        $session->delete();
        return $this->indexView();
    }

}
