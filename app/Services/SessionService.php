<?php


namespace App\Services;


use App\Models\Movie;
use App\Models\Session;

class SessionService
{
    public function indexView()
    {
        $sessions = Session::with('movie')->get();
        return view('admin.sessions.index',compact('sessions'));
    }

    public function showView(Session $session)
    {
        return view('admin.sessions.show',compact('session'));
    }

    public function store(array $request)
    {
        $session = Session::create($request);
        return $this->indexView();
    }

    public function storeView()
    {
        $movies = Movie::all();
        return view('admin.sessions.store',compact('movies'));
    }

    public function updateView(Session $session)
    {
        $movies = Movie::all();
        return view('admin.sessions.update',compact('session','movies'));
    }
    public function destroy(Session $session){
        $session->delete();
        return $this->indexView();
    }

}
