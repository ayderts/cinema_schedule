<?php


namespace App\Services;


use App\Models\Movie;
use App\Models\Session;
use Illuminate\View\View;

class SessionService
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function indexView() : View
    {
        $sessions = Session::with('movie')->get();
        return view('admin.sessions.index',compact('sessions'));
    }

    /**
     * @param Session $session
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function showView(Session $session) : View
    {
        return view('admin.sessions.show',compact('session'));
    }

    /**
     * @param array $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function store(array $request) : View
    {
        $session = Session::create($request);
        return $this->indexView();
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function storeView() : View
    {
        $movies = Movie::all();
        return view('admin.sessions.store',compact('movies'));
    }

    /**
     * @param Session $session
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function updateView(Session $session) : View
    {
        $movies = Movie::all();
        return view('admin.sessions.update',compact('session','movies'));
    }

    public function update(Session $session, array $request) : View
    {

        $data = array_filter($request, fn($value) => !is_null($value) && $value !== '');

        $session->update($data);

        return view('admin.sessions.show', compact('session'));
    }
    /**
     * @param Session $session
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function destroy(Session $session) : View
    {
        $session->delete();
        return $this->indexView();
    }

}
